<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Application;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\NewApplicationNotification;
use App\Notifications\ApplicationAcceptNotification;
use App\Notifications\ApplicationRejectNotification;
use App\Notifications\ApplicationSubmitNotification;

class JobController extends Controller
{
    use AuthorizesRequests;
    // Cégek: saját hirdetések listázása
    public function index()
    {
        $company = Auth::guard('company')->user();
        $jobs = $company->jobs()->get();

        return view('jobs.index', compact('jobs'));
    }

    // Cégek: hirdetés létrehozása
    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);
        $company = Auth::guard('company')->user();
        $company->jobs()->create($request->all());
        return redirect()->route('jobs.index')->with('success', 'Álláshirdetés létrehozva!');
    }

    // Cégek: hirdetés szerkesztése
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);
        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Álláshirdetés frissítve!');
    }

    // Cégek: hirdetés törlése
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Álláshirdetés törölve!');
    }
    
    // Felhasználók: összes hirdetés listázása
    public function list()
    {
        $jobs = Job::all();
        return view('jobs.list', compact('jobs'));
    }

    // Felhasználók: jelentkezés egy hirdetésre
    public function apply(Job $job)
    {
        $user = Auth::guard('web')->user();
        // Ellenőrizzük, hogy van-e már jelentkezés ehhez az álláshoz
        $existing = $job->applications()->where('user_id', $user->id)->first();
        if ($existing) {
            if ($existing->status === 'archived') {
                return redirect()->back()->with('error', 'Már jelentkeztél erre az állásra, a korábbi jelentkezés archiválva lett.');
            }
            return redirect()->back()->with('error', 'Már jelentkeztél erre az állásra!');
        }
        // Ha nincs korábbi jelentkezés, létrehozzuk
        $application = $job->applications()->create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);
        $company = $job->company;
        $company->notify(new NewApplicationNotification($application));
        // Értesítés a felhasználónak a sikeres jelentkezésről
        $user->notify(new ApplicationSubmitNotification($application));
        return redirect()->back()->with('success', 'Sikeres jelentkezés!');
    }

    public function applications(Job $job)
    {
        $company = Auth::guard('company')->user();
        if ($job->company_id !== $company->id) abort(403);
        $applications = $job->applications()->with('user')->get();
        return view('jobs.applications', compact('job', 'applications'));
    }

    public function show(Application $application)
    {
        $company = Auth::guard('company')->user();
        if ($application->job->company_id !== $company->id) abort(403);
        return view('applications.show', compact('application'));
    }
}