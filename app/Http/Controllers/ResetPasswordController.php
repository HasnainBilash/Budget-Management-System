<?php
// File: app/Http/Controllers/ResetPasswordController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('auth.reset')->with('email', $request->email);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Reset password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'Password reset successful.');
    }
}