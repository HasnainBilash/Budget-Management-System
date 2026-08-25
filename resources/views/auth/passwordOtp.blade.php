<!-- File: resources/views/auth/passwordOtp.blade.php -->
@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Reset your password</h1>
            <p class="mt-1 text-sm text-slate-500">We'll email you a one-time code</p>
        </div>

        <div class="card card-body">
            @include('partials.alerts')

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="input">
                </div>
                <button type="submit" class="btn-primary w-full py-2.5">Send code</button>
            </form>

            <div class="my-6 flex items-center gap-3">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="text-xs uppercase tracking-wide text-slate-400">Already have a code?</span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <div class="field">
                    <label for="otp" class="label">One-time code</label>
                    <input type="text" id="otp" name="otp" required class="input tracking-widest" inputmode="numeric" autocomplete="one-time-code">
                </div>
                <button type="submit" class="btn-secondary w-full py-2.5">Verify code</button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Back to login</a>
        </p>
    </div>
</div>
@endsection
