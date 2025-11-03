<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Handle the incoming request to resend the verification email.
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/')->with('success', 'Az email címed már meg van erősítve.');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Új megerősítő email elküldve az email címedre.');
    }
}
