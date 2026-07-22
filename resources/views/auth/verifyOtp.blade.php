<!--resources/views/auth/verifyOtp.blade.php-->
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Verify OTP</h1>

        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP:</label>
                <input type="text" id="otp" name="otp" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                Verify OTP
            </button>
        </form>
    </div>
</div>
@endsection