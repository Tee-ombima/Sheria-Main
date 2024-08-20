<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    // Show Resend Verification Email Form
    public function showResendEmailForm()
    {
        return view('resend-email');
    }

    // Resend Verification Email
    public function resendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = Auth::user()->where('email', $request->email)->first();

        if ($user) {
            $user->sendEmailVerificationNotification();
            return redirect()->back()->with('success', 'Verification email has been resent.');
        } else {
            return redirect()->back()->with('error', 'No user found with this email address.');
        }
    }
}
