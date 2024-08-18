<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->verification_code === $request->code && Carbon::now()->lessThanOrEqualTo($user->verification_code_expires_at)) {
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->verification_code_expires_at = null;
            $user->save();

            Auth::login($user);

            return redirect()->route('/')->with('success', 'Your email has been verified.');
        }

        return back()->withErrors(['code' => 'The verification code is incorrect or has expired.']);
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $verification_code = Str::random(6);
            $verification_code_expires_at = Carbon::now()->addMinutes(5);

            $user->verification_code = $verification_code;
            $user->verification_code_expires_at = $verification_code_expires_at;
            $user->save();

            Mail::send('emails.verify', ['code' => $verification_code], function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Email Verification Code');
            });

            return back()->with('status', 'A new verification code has been sent to your email address.');
        }

        return back()->withErrors(['email' => 'There was a problem resending the verification code.']);
    }
}
