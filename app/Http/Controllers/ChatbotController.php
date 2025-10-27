<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['response' => 'Üres üzenetet nem tudok feldolgozni.']);
        }

        // 🔹 1. Ellenőrizzük, hogy a kérdés az adatbázisból válaszolható-e
        $reply = $this->handleDatabaseQuery($message);

        if ($reply !== null) {
            return response()->json(['response' => $reply]);
        }

        // 🔹 2. Ha nem adatbázisos kérdés, hívjuk meg az AI modellt
        $apiKey = env('GROQ_API_KEY');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => 'Te egy segítőkész asszisztens vagy az álláskereső portálhoz, magyarul válaszolsz.'],
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            if ($response->failed()) {
                Log::error('Groq API hiba: ' . $response->body());
                return response()->json(['response' => 'Hiba történt a chatbot működése közben.']);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'Nem érkezett válasz.';

        } catch (\Exception $e) {
            Log::error('Groq API kivétel: ' . $e->getMessage());
            $reply = 'Nem tudtam kapcsolatba lépni az AI szerverrel.';
        }

        return response()->json(['response' => $reply]);
    }

    /**
     * 🔍 Adatbázis-alapú kérdésfelismerés és válasz
     */
    private function handleDatabaseQuery($message)
{
    $messageLower = mb_strtolower($message, 'UTF-8');
    $user = auth()->user();

    // ======================================================
    // 🔹 PROFIL INFORMÁCIÓK
    // ======================================================
    if (str_contains($messageLower, 'nevem') || str_contains($messageLower, 'profilom neve')) {
        return $user ? "A profilod neve: {$user->name}." : "Nem vagy bejelentkezve.";
    }

    if (str_contains($messageLower, 'email') || str_contains($messageLower, 'e-mail')) {
        return $user ? "Az email címed: {$user->email}." : "Nem vagy bejelentkezve.";
    }

    if (str_contains($messageLower, 'profilkép') || str_contains($messageLower, 'profil kép')) {
        if (!$user) return "Nem vagy bejelentkezve.";
        return $user->profile_picture 
            ? "Igen, van feltöltött profilképed." 
            : "Még nincs profilképed feltöltve.";
    }

    if (str_contains($messageLower, 'regisztrált') || str_contains($messageLower, 'mióta')) {
        if (!$user) return "Nem vagy bejelentkezve.";
        $days = now()->diffInDays($user->created_at);
        $months = now()->diffInMonths($user->created_at);
        return "Kb. {$months} hónapja ({$days} napja) regisztráltál a portálra.";
    }

    if (str_contains($messageLower, 'frissítve') || str_contains($messageLower, 'utoljára módosítva')) {
        if (!$user) return "Nem vagy bejelentkezve.";
        $days = now()->diffInDays($user->updated_at);
        return "A profilod {$days} napja lett utoljára módosítva.";
    }

    // ======================================================
    // 🔹 JELENTKEZÉSEK (APPLICATIONS)
    // ======================================================
    if (str_contains($messageLower, 'jelentkezésem') || str_contains($messageLower, 'jelentkezéseim')) {
        if (!$user) return "Ehhez be kell jelentkezned.";

        $apps = DB::table('applications')
            ->join('jobs', 'applications.job_id', '=', 'jobs.id')
            ->select('applications.status', 'jobs.title', 'jobs.company')
            ->where('applications.user_id', $user->id)
            ->get();

        if ($apps->isEmpty()) {
            return "Még nem jelentkeztél egyetlen állásra sem.";
        }

        $count = $apps->count();
        $accepted = $apps->where('status', 'accepted')->count();
        $rejected = $apps->where('status', 'rejected')->count();
        $pending = $count - $accepted - $rejected;

        $list = $apps->map(fn($a) => "{$a->title} ({$a->company}, {$a->status})")->implode(', ');

        return "Összesen {$count} állásra jelentkeztél. Elfogadva: {$accepted}, elutasítva: {$rejected}, függőben: {$pending}. Jelentkezéseid: {$list}";
    }

    // ======================================================
    // 🔹 VÁROSOK FELISMERÉSE AZ ADATBÁZISBÓL
    // ======================================================
    $cities = DB::table('jobs')->distinct()->pluck('location');
foreach ($cities as $city) {
    $normalizedCity = trim(mb_strtolower(preg_replace('/[^a-záéíóöőúüű\s]/iu', '', $city)));
    $normalizedMsg = trim(mb_strtolower(preg_replace('/[^a-záéíóöőúüű\s]/iu', '', $message)));
    
    if (str_contains($normalizedMsg, $normalizedCity)) {
        $jobs = DB::table('jobs')
            ->where('location', 'like', "%$city%")
            ->select('title', 'company', 'salary')
            ->limit(5)
            ->get();

        if ($jobs->isEmpty()) return "Nem találtam állásokat $city városban.";

        $list = $jobs->map(fn($j) => "{$j->title} ({$j->company}, {$j->salary} Ft)")->implode(', ');
        return "Néhány elérhető állás $city városban: $list";
    }
}

    // ======================================================
    // 🔹 CÉG FELISMERÉS
    // ======================================================
    $companies = DB::table('companies')->pluck('name');
    foreach ($companies as $company) {
        $companyLower = mb_strtolower($company, 'UTF-8');
        if (str_contains($messageLower, $companyLower)) {
            $jobs = DB::table('jobs')
                ->where('company', 'like', "%$company%")
                ->select('title', 'location', 'salary')
                ->limit(5)
                ->get();

            if ($jobs->isEmpty()) return "A(z) {$company} cégnek jelenleg nincsenek aktív hirdetései.";
            $list = $jobs->map(fn($j) => "{$j->title} ({$j->location}, {$j->salary} Ft)").implode(', ');
            return "A(z) {$company} hirdetései: $list";
        }
    }

    // ======================================================
    // 🔹 FIZETÉS SZŰRÉS
    // ======================================================
    if (preg_match('/(\d{5,6})\s*Ft/i', $message, $matches)) {
        $salary = intval($matches[1]);
        $jobs = DB::table('jobs')
            ->where('salary', '>=', $salary)
            ->select('title', 'company', 'location', 'salary')
            ->orderByDesc('salary')
            ->limit(5)
            ->get();

        if ($jobs->isEmpty()) return "Nem találtam {$salary} Ft feletti fizetésű állást.";
        $list = $jobs->map(fn($j) => "{$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)")->implode(', ');
        return "Néhány {$salary} Ft feletti fizetésű állás: {$list}";
    }

    // ======================================================
    // 🔹 MUNKA TÍPUSOK (teljes, részmunkaidő, gyakornok, hibrid)
    // ======================================================
    $types = ['teljes', 'rész', 'gyakornok', 'hibrid'];
    foreach ($types as $type) {
        if (str_contains($messageLower, $type)) {
            $jobs = DB::table('jobs')
                ->where('type', 'like', "%$type%")
                ->select('title', 'company', 'location', 'salary')
                ->limit(5)
                ->get();

            if ($jobs->isEmpty()) return "Nem találtam {$type} munkaidős állásokat.";
            $list = $jobs->map(fn($j) => "{$j->title} ({$j->company}, {$j->location}, {$j->salary} Ft)")->implode(', ');
            return "Néhány {$type} munkaidős állás: {$list}";
        }
    }

    // Ha egyik logika sem talált semmit → térjünk vissza null-lal (AI-hoz kerül)
    return null;
}
}