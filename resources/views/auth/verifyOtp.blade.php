<!--resources/views/auth/verifyOtp.blade.php-->
@extends('layouts.app')

@section('title', 'Verify Code')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Verify your code</h1>
            <p class="mt-1 text-sm text-slate-500">Enter the one-time code we emailed you</p>
        </div>

        <div class="card card-body">
            @include('partials.alerts')

            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="field">
                    <label for="otp" class="label">One-time code</label>
                    <input type="text" id="otp" name="otp" required autofocus class="input tracking-widest" inputmode="numeric" autocomplete="one-time-code">
                </div>
                <button type="submit" class="btn-primary w-full py-2.5">Verify code</button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="font-medium text-emerald-700 hover:text-emerald-800">Back to login</a>
        </p>
    </div>
</div>
@endsection
