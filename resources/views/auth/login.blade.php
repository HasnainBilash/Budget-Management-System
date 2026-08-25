<!-- File: resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Welcome back</h1>
            <p class="mt-1 text-sm text-slate-500">Log in to manage your tasks and budget</p>
        </div>

        <div class="card card-body">
            @include('partials.alerts')

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="input">
                </div>
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" name="password" required class="input">
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-800">Forgot password?</a>
                </div>
                <button type="submit" class="btn-primary w-full py-2.5">Log in</button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Sign up</a>
        </p>
    </div>
</div>
@endsection
