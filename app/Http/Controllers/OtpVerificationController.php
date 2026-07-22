<?php
// File: app/Http/Controllers/OtpVerificationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Otp;
use Carbon\Carbon;

class OtpVerificationController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        // Validate OTP
        $otpRecord = Otp::where('email', $request->email)
                        ->where('otp', $request->otp)
                        ->where('expires_at', '>', Carbon::now())
                        ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Delete OTP record
        $otpRecord->delete();

        return redirect()->route('password.reset', ['email' => $request->email]);
    }
}