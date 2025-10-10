<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Notifications\ApplicationSubmitNotification;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the authenticated user's applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $applications = Application::with(['job', 'user'])->get();

        return view('applications.index', compact('applications'));
    }

    /**
     * Store a new application and notify the user.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $jobId = $request->input('job_id');

        // létrehozzuk a jelentkezést
        $application = Application::create([
            'user_id' => $user->id,
            'job_id' => $jobId,
            'status' => 'pending'
        ]);

        // lekérjük az állás címét
        $jobTitle = $application->job->title;

        // értesítjük a felhasználót emailben
        $user->notify(new ApplicationSubmitNotification($jobTitle));

        return redirect()->back()->with('success', 'Sikeresen jelentkeztél az állásra!');
    }

    /**
     * Accept the application with the given ID.
     */
    public function accept($id)
    {
        $application = Application::find($id);

        if ($application) {
            $application->status = 'accepted';
            $application->save();
            if ($application->user) {
                $application->user->notify(new \App\Notifications\ApplicationAcceptNotification($application));
            }
        }

        return redirect()->back();
    }

    /**
     * Reject the application with the given ID.
     */
    public function reject($id)
    {
        $application = Application::find($id);

        if ($application) {
            $application->status = 'rejected';
            $application->save();
            if ($application->user) {
                $application->user->notify(new \App\Notifications\ApplicationRejectNotification($application));
            }
        }

        return redirect()->back();
    }

    /**
     * Delete the application with the given ID.
     */
    public function destroy($id)
    {
        $application = Application::find($id);

        if ($application) {
            $application->delete();
        }

        return redirect()->back();
    }
}