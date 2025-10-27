<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    /**
     * Adatbázis-alapú állásajánló
     */
    public function recommend(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['response' => 'Ehhez be kell jelentkezned.']);
        }

        // 1. Gyűjtsük össze a felhasználó adatait
        $userSkills = $user->skills ?? []; // például skills mező tömbként
        $previousApplications = DB::table('applications')
            ->where('user_id', $user->id)
            ->pluck('job_id')
            ->toArray();

        // 2. Kérdezzük le az állásokat
        $jobs = DB::table('jobs')
            ->select('id', 'title', 'company', 'location', 'type', 'salary', 'keywords')
            ->get();

        // 3. Pontozzuk az állásokat a relevancia alapján
        $rankedJobs = $jobs->map(function ($job) use ($userSkills, $previousApplications) {
            $score = 0;

            // 3a. Ha még nem jelentkezett az állásra
            if (!in_array($job->id, $previousApplications)) {
                $score += 10;
            }

            // 3b. Kulcsszavak egyezése a felhasználó készségeivel
            if ($job->keywords) {
                $jobKeywords = array_map('trim', explode(',', $job->keywords));
                $matches = count(array_intersect($jobKeywords, $userSkills));
                $score += $matches * 5;
            }

            // 3c. Típus előny: teljes/részmunkaidő, gyakornok stb.
            if ($job->type && property_exists($user, 'preferred_type') && $job->type == $user->preferred_type) {
                $score += 3;
            }

            $job->score = $score;
            return $job;
        });

        // 4. Rangsorolás pontszám alapján csökkenő sorrendben
        $rankedJobs = $rankedJobs->sortByDesc('score')->values();

        // 5. Legjobb 5 ajánlás
        $topJobs = $rankedJobs->take(5)->map(function ($job) {
            return "{$job->title} ({$job->company}, {$job->location}, {$job->salary} Ft)";
        });

        if ($topJobs->isEmpty()) {
            return response()->json(['response' => 'Jelenleg nincs releváns ajánlás.']);
        }

        return response()->json([
            'response' => 'Az Önnek ajánlott állások: ' . $topJobs->implode(', ')
        ]);
    }
}