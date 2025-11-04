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
        $user = Auth::guard('web')->user();

        $applications = Application::with(['job', 'user'])
            ->where('user_id', $user->id)
            ->get();

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

        return redirect()->back()->with('success', 'A jelentkezést elfogadtad');
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

        return redirect()->back()->with('error', 'A jelentkezést elutasítottad');
    }

    /**
     * Delete an application by the logged-in user.
     */
    public function destroyUser($id)
    {
        try {
            $application = Application::findOrFail($id);
            $user = Auth::guard('web')->user();

            if ($application->user_id !== $user->id) {
                return redirect('/my-applications')->with('error', 'Nincs jogosultságod ennek a jelentkezésnek a törléséhez.');
            }

            $application->delete();

            return redirect('/my-applications')->with('success', 'A jelentkezés sikeresen törölve lett.');
        } catch (\Exception $e) {
            return redirect('/my-applications')->with('error', 'Hiba történt a törlés közben. Kérjük, próbáld újra.');
        }
    }

    /**
     * Delete an application by the company.
     */
    public function destroyCompany($id)
    {
        try {
            $application = Application::findOrFail($id);
            $company = Auth::guard('company')->user();

            if (!$application->job || $application->job->company_id !== $company->id) {
                return redirect()->back()->with('error', 'Nincs jogosultságod ennek a jelentkezésnek a törléséhez.');
            }

            $application->delete();

            return redirect()->back()->with('success', 'A jelentkezést törölted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hiba történt a törlés közben. Kérjük, próbáld újra.');
        }
    }
}