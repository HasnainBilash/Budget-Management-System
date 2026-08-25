<!-- File: resources/views/auth/reset.blade.php -->
@extends('layouts.app')

@section('title', 'Set New Password')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-600 text-white mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Set a new password</h1>
            <p class="mt-1 text-sm text-slate-500">Choose something you haven't used before</p>
        </div>

        <div class="card card-body">
            @include('partials.alerts')

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="field">
                    <label for="password" class="label">New password</label>
                    <input type="password" id="password" name="password" required autofocus class="input">
                </div>
                <div class="field">
                    <label for="password_confirmation" class="label">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="input">
                </div>
                <button type="submit" class="btn-primary w-full py-2.5">Update password</button>
            </form>
        </div>
    </div>
</div>
@endsection
