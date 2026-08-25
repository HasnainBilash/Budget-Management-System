<!-- File: resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Create your account</h1>
            <p class="mt-1 text-sm text-slate-500">Start organizing your tasks and budget for free</p>
        </div>

        <div class="card card-body">
            @include('partials.alerts')

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus class="input">
                </div>
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="input">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="field">
                        <label for="phone" class="label">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required class="input">
                    </div>
                    <div class="field">
                        <label for="dob" class="label">Date of birth</label>
                        <input type="date" id="dob" name="dob" value="{{ old('dob') }}" required class="input">
                    </div>
                </div>
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" name="password" required class="input">
                </div>
                <div class="field">
                    <label for="password_confirmation" class="label">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="input">
                </div>
                <button type="submit" class="btn-primary w-full py-2.5 mt-2">Create account</button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Log in</a>
        </p>
    </div>
</div>
@endsection
