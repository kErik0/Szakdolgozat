<?php
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobController;
use App\Models\Job;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\Auth\SendEmailVerificationNotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Auth\PasswordController;




Route::get('/', [JobController::class, 'browse'])->name('jobs.browse');

// Admin route külön URL-lel
Route::get('/admin', function () {
    $user = Auth::user();

    if (!$user || $user->role !== 'admin') {
        return redirect()->route('dashboard')
                         ->with('error', 'Nincs jogosultságod az admin oldalhoz.');
    }

    return view('dashboard-admin', ['user' => $user]);
})->middleware(['auth'])->name('admin');

Route::middleware(['auth:web,company'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-picture', [ProfileController::class, 'uploadProfilePicture'])->name('profile.photo.update');
    Route::delete('/profile/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.photo.destroy');
    Route::post('/profile/upload-cv', [ProfileController::class, 'uploadCV'])->name('profile.cv.update');
    Route::delete('/profile/delete-cv', [ProfileController::class, 'deleteCV'])->name('profile.cv.destroy');
    Route::get('/recommendations', [RecommendationController::class, 'recommend'])->name('recommendations');
    Route::patch('/password', [PasswordController::class, 'update'])->middleware(['auth:web,company'])->name('password.update');
    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        if ($user = $request->user('web')) {
            $user->sendEmailVerificationNotification();
        } elseif ($company = $request->user('company')) {
            $company->sendEmailVerificationNotification();
        }
        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::post('/logout', function (Request $request) {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::post('/company/logout', function (Request $request) {
        if (Auth::guard('company')->check()) {
            Auth::guard('company')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('company.logout');
});

Route::middleware(['auth:company'])->group(function() {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{job}/applications', [JobController::class, 'applications'])->name('jobs.applications');
    Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
    // Cégek törölhetik a jelentkezéseket
    Route::delete('/company/applications/{id}', [ApplicationController::class, 'destroyCompany'])
        ->middleware(['auth:company'])
        ->name('applications.destroyCompany');
    Route::patch('/company/update-description', [CompanyController::class, 'updateDescription'])->name('company.updateDescription');
});

// Felhasználók (álláskeresők)
Route::get('/all-jobs', function () {
    $user = Auth::user();
    $jobs = Job::all();
    $appliedJobs = $user ? $user->applications()->pluck('job_id')->toArray() : [];
    return view('dashboard-user', compact('user', 'jobs', 'appliedJobs'));
})->middleware(['auth:web'])->name('jobs.list');

// Jelentkezés egy állásra (vendégek is láthatják, de csak bejelentkezve tudnak jelentkezni)
Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

// Saját jelentkezések megtekintése (csak bejelentkezett felhasználóknak)
Route::middleware(['auth:web'])->group(function() {
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::delete('/my-applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    // Felhasználók törölhetik a saját jelentkezéseiket
    Route::delete('/my-applications/{id}', [ApplicationController::class, 'destroyUser'])
        ->middleware(['auth:web'])
        ->name('applications.destroyUser');
});

Route::prefix('company')->name('company.')->group(function () {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/'); 
    })->middleware(['auth:company', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user('company')->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware(['auth:company', 'throttle:6,1'])->name('verification.send');
});

Route::post('/chatbot', [ChatbotController::class, 'handle'])->name('chatbot.handle');
Route::get('/dashboard-company', [DashboardCompanyController::class, 'index'])->name('dashboard-company');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/companies/{company}', [DashboardCompanyController::class, 'show'])->name('companies');

require __DIR__.'/auth.php';