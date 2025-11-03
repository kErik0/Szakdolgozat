<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        if ($user instanceof \App\Models\Company) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'tax_number' => 'required|string|max:50',
                'phone' => 'required|string|max:50',
            ]);
            $user->fill($request->only(['name','email','address','tax_number','phone']));
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);
            $user->fill($request->only(['name','email']));
        }

        $passwordChanged = false;
        $profileChanged = $user->isDirty();

        if ($request->has('update_password') && $request->filled('password')) {
            $user->password = $request->password;
            $passwordChanged = true;
        }

        if ($passwordChanged && $profileChanged) {
            $user->save();
            $user->notify(new \App\Notifications\PasswordChangedNotification());
            return Redirect::route('profile.edit')->with('status', 'profile-and-password-updated');
        } elseif ($passwordChanged) {
            $user->save();
            $user->notify(new \App\Notifications\PasswordChangedNotification());
            return Redirect::route('profile.edit')->with('status', 'password-updated');
        } elseif ($profileChanged) {
            $user->save();
            return Redirect::route('profile.edit')->with('success', 'Profil sikeresen frissítve.');
        } else {
            // Nincs változás, ne írjuk felül a státuszt
            return Redirect::route('profile.edit')->with('error', 'Nem történt módosítás a profilban.');
        }
    }

    public function uploadProfilePicture(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();
        if (!$request->hasFile('profile_picture')) {
            return redirect()->back()->with('error', 'Nem sikerült feltölteni a profilképet. Nincs fájl kiválasztva.');
        }

        $request->validate([
            'profile_picture' => 'required|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $file = $request->file('profile_picture');
        $imageName = time().'_'.$user->id.'.'.$file->getClientOriginalExtension();

        // régi kép törlése, ha létezik
        $oldPath = $user instanceof \App\Models\Company ? $user->logo : $user->profile_picture;
        if ($oldPath && file_exists(storage_path('app/public/' . str_replace('storage/', '', $oldPath)))) {
            unlink(storage_path('app/public/' . str_replace('storage/', '', $oldPath)));
        }

        // új kép mentése
        $file->storeAs('profile_pictures', $imageName, 'public');
        $relativePath = 'storage/profile_pictures/' . $imageName;

        // adatbázis frissítés
        if ($user instanceof \App\Models\Company) {
            $user->logo = $relativePath;
        } else {
            $user->profile_picture = $relativePath;
        }

        $user->save();

        // cache elkerülése: redirect friss cache-busterrel
        return redirect()->back()->with('success', 'Profilkép sikeresen feltöltve!')->with('timestamp', time());
    }

    /**
     * Delete the user's profile picture (javított verzió).
     */
    public function deleteProfilePicture(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        $path = $user instanceof \App\Models\Company ? $user->logo : $user->profile_picture;

        if ($path) {
            $filePath = storage_path('app/public/' . str_replace('storage/', '', $path));
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            if ($user instanceof \App\Models\Company) {
                $user->logo = null;
            } else {
                $user->profile_picture = null;
            }
            $user->save();

            return redirect()->back()->with('success', 'Profilkép sikeresen törölve!');
        }

        return redirect()->back()->with('error', 'Nincs profilkép a törléshez.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        try {
            // Jelentkezések törlése
            if (method_exists($user, 'applications')) {
                $user->applications()->delete();
            }

            // CV törlése, ha van
            if ($user->resume && file_exists(public_path('storage/cvs/' . $user->resume))) {
                unlink(public_path('storage/cvs/' . $user->resume));
            }

            // Profilkép / logó törlése, ha van
            $profilePicPath = $user instanceof \App\Models\Company ? $user->logo : $user->profile_picture;
            if ($profilePicPath && file_exists(storage_path('app/public/' . str_replace('storage/', '', $profilePicPath)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $profilePicPath)));
            }

            // Email értesítés a törlésről
            $user->notify(new \App\Notifications\AccountDeleteNotification());

            Auth::logout();

            // Fiók törlése
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/')->with('success', 'A fiók törölve lett.');
        } catch (\Throwable $e) {
            return Redirect::back()->with('error', 'Hiba történt a fiók vagy az adatok törlése során.');
        }
    }

    /**
     * Upload the user's CV (resume).
     */
    public function uploadCV(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        if (!$request->hasFile('cv')) {
            return redirect()->back()->with('error', 'Nem sikerült feltölteni az önéletrajzot. Nincs fájl kiválasztva.');
        }

        $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx|max:10240', // 10MB
        ]);

        $file = $request->file('cv');
        $cvName = time().'_'.$user->id.'.'.$file->getClientOriginalExtension();
        $file->storeAs('cvs', $cvName, 'public');
        $user->resume = $cvName;
        $user->save();

        return redirect()->back()->with('success', 'Önéletrajz sikeresen feltöltve!');
    }

    /**
     * Delete the user's CV (resume).
     */
    public function deleteCV(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::guard('company')->user();

        $filename = $user->resume;

        if ($filename) {
            $filePath = public_path('storage/cvs/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $user->resume = null;
            $user->save();

            return redirect()->back()->with('success', 'Önéletrajz sikeresen törölve!');
        }

        return redirect()->back()->with('error', 'Nincs feltöltött önéletrajz a törléshez.');
    }

    /**
     * Letölti a megadott user önéletrajzát (CV) - csak company guard számára, biztonságosan.
     */
    public function downloadCV($userId)
    {
        // Csak company guard alatt érhető el
        $company = Auth::guard('company')->user();
        if (!$company) {
            abort(403, 'Nincs jogosultság.');
        }

        // Megkeressük a usert (feltételezzük, hogy App\Models\User)
        $user = \App\Models\User::find($userId);
        if (!$user || !$user->resume) {
            abort(404, 'A felhasználó nem rendelkezik önéletrajzzal.');
        }

        // Fájl elérési útja
        $file = public_path('storage/cvs/' . $user->resume);
        if (!file_exists($file)) {
            abort(404, 'A fájl nem található.');
        }

        return response()->download($file, $user->resume);
    }
}
