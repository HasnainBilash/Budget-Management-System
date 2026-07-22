<?php
// File: app/Http/Controllers/ForgetPasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ForgetPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwordOtp');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate OTP
        $otp = rand(100000, 999999);
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        // Debugging: Log the OTP
        Log::info('Generated OTP:', ['email' => $request->email, 'otp' => $otp]);

        // Send OTP via email
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });

        // Debugging: Log the email sending
        Log::info('OTP email sent to:', ['email' => $request->email]);

        return back()->with(['status' => 'OTP sent to your email.', 'email' => $request->email]);
    }
}