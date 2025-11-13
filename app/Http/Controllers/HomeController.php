<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobView;

class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::guard('web')->id();
        $recommendedJobs = collect();

        if ($userId) {
            // Megnézett állások pozíciói
            $viewedPositions = Job::whereIn('id', function($q) use ($userId) {
                $q->select('job_id')->from('job_views')->where('user_id', $userId);
            })->pluck('position')->toArray();

            // Jelentkezett állások pozíciói
            $appliedPositions = Job::whereIn('id', function($q) use ($userId) {
                $q->select('job_id')->from('applications')->where('user_id', $userId);
            })->pluck('position')->toArray();

            // Egyedi pozíciók összevonása
            $positions = collect(array_merge($viewedPositions, $appliedPositions))
                ->flatten()
                ->unique()
                ->values();

            // Ajánlott állások keresése
            if ($positions->count() > 0) {
                // Jelentkezett állások kizárása
                $appliedJobIds = \App\Models\Application::where('user_id', $userId)
                    ->pluck('job_id')
                    ->toArray();

                $recommendedJobs = Job::whereIn('position', $positions)
                    ->whereNotIn('id', $appliedJobIds)
                    ->limit(6)
                    ->get();
            }

            return view('index', [
                'recommendedJobs' => $recommendedJobs
            ]);
        } else {
            // Guest: cookie alapú megtekintett állások (7 napig megőrizve)
            $viewedJobIds = json_decode(request()->cookie('viewed_jobs', '[]'), true);
            if (!empty($viewedJobIds)) {
                $viewedJobs = Job::whereIn('id', $viewedJobIds)->take(6)->get();
            } else {
                $viewedJobs = collect(); // üres gyűjtemény, ha nincs megtekintett állás
            }

            return view('index', [
                'viewedJobs' => $viewedJobs
            ]);
        }
    }
}
