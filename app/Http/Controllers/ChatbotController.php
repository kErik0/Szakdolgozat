<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    // Normalize text: lowercase, remove accents
    private function normalize($text)
    {
        $text = mb_strtolower($text, 'UTF-8');

        $map = [
            'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ö'=>'o','ő'=>'o','ú'=>'u','ü'=>'u','ű'=>'u',
            'Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ö'=>'o','Ő'=>'o','Ú'=>'u','Ü'=>'u','Ű'=>'u'
        ];
        return strtr($text, $map);
    }

    public function handle(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['response' => 'Üres üzenetet nem tudok feldolgozni.']);
        }

        // 1. Először megpróbálunk adatbázisból válaszolni
        $reply = $this->handleDatabaseQuery($message);

        if ($reply !== null) {
            return response()->json(['response' => $reply]);
        }

        // 2. Ha nincs DB-alapú válasz, akkor használjuk az AI-t
        $apiKey = env('GROQ_API_KEY');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => 'Te egy segítőkész asszisztens vagy egy magyar álláskereső portálon.'],
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if ($response->failed()) {
                Log::error('Groq API hiba: '.$response->body());
                return response()->json(['response' => 'A chatbot szervere nem válaszol.']);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'Nem érkezett válasz.';

        } catch (\Exception $e) {
            Log::error('Groq API kivétel: '.$e->getMessage());
            $reply = 'Nem tudtam kapcsolatba lépni az AI szerverrel.';
        }

        return response()->json(['response' => $reply]);
    }


    // ========================
    // 🔍 ADATBÁZISOS LOGIKA
    // ========================
    private function handleDatabaseQuery($message)
    {
        $msg = mb_strtolower($message, 'UTF-8');
        $user = auth()->user();

        // ========================
        // ✅ AI-alapú intelligens kulcsszó-keresés (pozíció, város, fizetés, típus)
        // ========================
        try {
            $apiKey = env('GROQ_API_KEY');

            $aiResponse = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' =>
                        "Feladat: A felhasználói üzenetből kulcsszavakat kell kinyerni álláskereséshez.
                        Visszatérési forma: JSON tömb, pl.: [\"frontend\", \"developer\", \"budapest\", \"junior\", \"600000\"].
                        Mindig kisbetűsen válaszolj.
                        Csak kulcsszavakat adj vissza.
                        Ne adj vissza magyarázatot."
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 100,
                'temperature' => 0.0,
            ]);

            $json = json_decode($aiResponse->json()['choices'][0]['message']['content'] ?? "[]", true);
            $keywords = is_array($json) ? $json : [];
        } catch (\Exception $e) {
            $keywords = [];
        }

        // Ha vannak AI kulcsszavak → adatbázis keresés
        if (!empty($keywords)) {

            $jobs = DB::table('jobs')
                ->join('companies','jobs.company_id','=','companies.id')
                ->select('jobs.title','jobs.position','companies.name as company','jobs.location','jobs.salary','jobs.salary_type')
                ->where(function($q) use ($keywords) {
                    foreach ($keywords as $word) {

                        // Fizetés szám felismerése
                        if (is_numeric($word)) {
                            $q->orWhere('jobs.salary','>=',intval($word));
                        }

                        // Kulcsszó keresés pozícióban, címben, cégben, városban
                        $q->orWhere('jobs.position','like',"%$word%")
                          ->orWhere('jobs.title','like',"%$word%")
                          ->orWhere('jobs.location','like',"%$word%")
                          ->orWhere('companies.name','like',"%$word%");
                    }
                })
                ->orderByDesc('jobs.created_at')
                ->limit(10)
                ->get();

            if (!$jobs->isEmpty()) {

                $list = $jobs->map(function ($j) {
                    $unit = ($j->salary_type === 'órabér') ? '/óra' : '/hó';
                    return "- {$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft{$unit})";
                })->implode("\n");

                return "A keresésed alapján talált állások:\n{$list}";
            }
        }


        // ========================
        // ✅ AJÁNLOTT ÁLLÁSOK FELISMERÉSE
        if (
            str_contains($msg, 'ajanlott') ||
            str_contains($msg, 'ajanlo') ||
            str_contains($msg, 'recommended') ||
            str_contains($msg, 'mit ajanlasz') ||
            str_contains($msg, 'nekem valo') ||
            str_contains($msg, 'mit talalsz nekem') ||
            str_contains($msg, 'mit javasolsz')
        ) {
            $userId = auth()->id();

            if (!$userId) {
                return "Az ajánlott állásokat csak bejelentkezve tudom megmutatni.";
            }

            // Megnézett pozíciók
            $viewed = DB::table('job_views')
                ->join('jobs','job_views.job_id','=','jobs.id')
                ->pluck('jobs.position')
                ->toArray();

            // Jelentkezett pozíciók
            $applied = DB::table('applications')
                ->join('jobs','applications.job_id','=','jobs.id')
                ->where('applications.user_id',$userId)
                ->pluck('jobs.position')
                ->toArray();

            $positions = collect(array_merge($viewed, $applied))
                ->unique()
                ->values();

            if ($positions->isEmpty()) {
                return "Még nincs elég információm ahhoz, hogy ajánlott állásokat mutassak. Nézz meg néhány állást vagy jelentkezz rájuk!";
            }

            // Ajánlott állások
            $jobs = DB::table('jobs')
                ->join('companies','jobs.company_id','=','companies.id')
                ->select('jobs.title','companies.name as company','jobs.location','jobs.salary','jobs.position')
                ->whereIn('jobs.position',$positions)
                ->limit(6)
                ->get();

            if ($jobs->isEmpty()) {
                return "Nem találtam ajánlott állást.";
            }

            $list = $jobs->map(function($j){
                return "- {$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)";
            })->implode("\n");

            return "Neked ajánlott állások:\n{$list}";
        }

        // ========================
        // ✅ PROFIL OLDAL FELISMERÉSE
        if (
            str_contains($msg, 'profil') ||
            str_contains($msg, 'profilom') ||
            str_contains($msg, 'profil oldal') ||
            str_contains($msg, 'hol a profil') ||
            str_contains($msg, 'beállítás') ||
            str_contains($msg, 'adat módosítás') ||
            str_contains($msg, 'adatok módosítása') ||
            str_contains($msg, 'hol tudom módosítani') ||
            str_contains($msg, 'saját profil')
        ) {
            return "A profil oldaladat itt éred el: /profile\nA jobb felső sarokban a nevedre kattintva is elérhető.";
        }

        // ========================
        // ✅ PROFIL INFO
        // ========================
        if (str_contains($msg, 'nevem') || str_contains($msg, 'profil nevem')) {
            return $user ? "A neved: {$user->name}." : "Nem vagy bejelentkezve.";
        }

        if (str_contains($msg, 'email')) {
            return $user ? "Az email címed: {$user->email}." : "Nem vagy bejelentkezve.";
        }

        if (str_contains($msg, 'profilkép')) {
            if (!$user) return "Nem vagy bejelentkezve.";
            return $user->profile_picture
                ? "Van feltöltött profilképed."
                : "Nincs feltöltött profilképed.";
        }

        if (str_contains($msg, 'regisztráltam') || str_contains($msg, 'mióta vagyok')) {
            if (!$user) return "Nem vagy bejelentkezve.";
            $days = now()->diffInDays($user->created_at);
            return "Kb. {$days} napja regisztráltál.";
        }


        // ========================
        // ✅ JELENTKEZÉSEK
        // ========================
        if (str_contains($msg, 'jelentkezésem') || str_contains($msg, 'jelentkezéseim')) {
            if (!$user) return "Ez a funkció csak bejelentkezve érhető el.";

            $apps = DB::table('applications')
                ->join('jobs', 'applications.job_id', '=', 'jobs.id')
                ->join('companies', 'jobs.company_id', '=', 'companies.id')
                ->select('jobs.title', 'companies.name as company', 'applications.status')
                ->where('applications.user_id', $user->id)
                ->get();

            if ($apps->isEmpty()) return "Még egyetlen állásra sem jelentkeztél.";

            $list = $apps->map(fn($a) => "{$a->title} ({$a->company}, státusz: {$a->status})")
                         ->implode(', ');

            return "Ezekre az állásokra jelentkeztél: {$list}";
        }


        // ========================
        // ✅ VÁROS FELISMERÉSE
        // ========================
        $cities = DB::table('jobs')->distinct()->pluck('location');

        foreach ($cities as $city) {

            $normalizedMsg = $this->normalize($msg);
            $normalizedCity = $this->normalize($city);

            // fuzzy match: city inside message OR message inside city
            if (str_contains($normalizedMsg, $normalizedCity) ||
                str_contains($normalizedCity, $normalizedMsg) ||
                levenshtein($normalizedMsg, $normalizedCity) <= 3) {

                $jobs = DB::table('jobs')
                    ->join('companies','jobs.company_id','=','companies.id')
                    ->select('jobs.title','companies.name as company','jobs.salary')
                    ->where('jobs.location',$city)
                    ->limit(5)->get();

                if ($jobs->isEmpty()) return "Nem találtam állást itt: {$city}.";

                $list = $jobs->map(fn($j) => "- {$j->title} ({$j->company}, {$j->salary} Ft)")
                             ->implode("\n");

                return "Néhány állás {$city} városban:\n{$list}";
            }
        }


        // ========================
        // ✅ CÉG FELISMERÉS
        // ========================
        $companies = DB::table('companies')->pluck('name');

        foreach ($companies as $company) {
            if (str_contains($msg, mb_strtolower($company))) {

                $jobs = DB::table('jobs')
                    ->where('company_id', function($q) use ($company) {
                        $q->select('id')->from('companies')->where('name',$company);
                    })
                    ->select('title','location','salary')
                    ->limit(5)->get();

                if ($jobs->isEmpty()) {
                    return "{$company} jelenleg nem adott fel állást.";
                }

                $list = $jobs->map(fn($j) =>
                    "- {$j->title} ({$j->location}, {$j->salary} Ft)"
                )->implode("\n");

                return "{$company} legfrissebb állásai:\n{$list}";
            }
        }


        // ========================
        // ✅ FIZETÉS SZŰRÉS
        // ========================
        if (preg_match('/(\d{5,7})/', $msg, $m)) {

            $salary = intval($m[1]);

            $jobs = DB::table('jobs')
                ->join('companies','jobs.company_id','=','companies.id')
                ->select('jobs.title','companies.name as company','jobs.location','jobs.salary')
                ->where('jobs.salary','>=',$salary)
                ->orderByDesc('jobs.salary')
                ->limit(5)
                ->get();

            if ($jobs->isEmpty()) {
                return "Nem találtam {$salary} Ft feletti fizetésű pozíciót.";
            }

            $list = $jobs->map(fn($j) =>
                "- {$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)"
            )->implode("\n");

            return "Legjobb {$salary} Ft feletti állások:\n{$list}";
        }


        // ========================
        // ✅ MUNKA TÍPUSOK felismerése
        // ========================
        $types = [
            'teljes' => 'Teljes munkaidő',
            'rész' => 'Rész munkaidő',
            'gyakornok' => 'Gyakornok',
            'hibrid' => 'Hibrid'
        ];

        foreach ($types as $key => $label) {
            if (str_contains($msg, $key)) {

                $jobs = DB::table('jobs')
                    ->join('companies','jobs.company_id','=','companies.id')
                    ->where('jobs.type',$label)
                    ->select('jobs.title','companies.name as company','jobs.location','jobs.salary')
                    ->limit(5)->get();

                if ($jobs->isEmpty()) return "Nem találtam {$label} állást.";

                $list = $jobs->map(fn($j) =>
                    "- {$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)"
                )->implode("\n");

                return "Néhány {$label} pozíció:\n{$list}";
            }
        }


        // ========================
        // ✅ POZÍCIÓ (POSITION) felismerése – "developer", "fejlesztő", stb.
        // ========================
        $positions = DB::table('jobs')->distinct()->pluck('position');

        foreach ($positions as $pos) {

            $normalizedMsg = $this->normalize($msg);
            $normalizedPos = $this->normalize($pos);

            if (
                str_contains($normalizedMsg, $normalizedPos) ||
                str_contains($normalizedPos, $normalizedMsg) ||
                levenshtein($normalizedMsg, $normalizedPos) <= 4
            ) {

                $jobs = DB::table('jobs')
                    ->join('companies','jobs.company_id','=','companies.id')
                    ->select('jobs.title','companies.name as company','jobs.location','jobs.salary')
                    ->where('jobs.position', $pos)
                    ->limit(8)
                    ->get();

                if ($jobs->isEmpty()) {
                    return "Nem találtam ilyen pozíciót: {$pos}.";
                }

                $list = $jobs->map(fn($j) =>
                    "- {$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)"
                )->implode("\n");

                return "Néhány talált pozíció ({$pos}):\n{$list}";
            }
        }


        return null; // átadjuk az AI-nak
    }
}