<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login Request
    public function postLogin(Request $request)
    {
        // Validate input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to dashboard
            return redirect()->intended('dashboard');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration Request
    public function postRegister(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|regex:/^[0-9]{10,15}$/',
            'dob' => 'required|date',
            'password' => [
                'required',
                'string',
                'min:8',             // Must be at least 8 characters
                'regex:/[a-z]/',      // Must contain at least one lowercase letter
                'regex:/[A-Z]/',      // Must contain at least one uppercase letter
                'regex:/[0-9]/',      // Must contain at least one digit
                'regex:/[@$!%*#?&]/', // Must contain a special character
                'confirmed'
            ],
        ]);

        // Debugging: Check if form data is being passed correctly
        // Log::info('Validated data:', $validated);
        // dd($request->all());

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'active' => true,
        ]);

        // Debugging: Check if user is successfully created
        // Log::info('Created user:', $user->toArray());
        // dd($user);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Handle Logout Request
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
