@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Manage users</h1>
            <p class="page-subtitle">Activate or deactivate accounts.</p>
        </div>
    </div>

    @include('partials.alerts')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($users as $user)
            <div class="card card-body">
                <div class="flex items-start justify-between gap-2 mb-1">
                    <h3 class="text-lg font-semibold text-slate-900">{{ $user->name }}</h3>
                    <span class="{{ $user->active ? 'badge-green' : 'badge-gray' }} shrink-0">
                        {{ $user->active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <p class="text-sm text-slate-500 mb-4">{{ $user->email }}</p>
                <form action="{{ route('admin.update-user-status', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="{{ $user->active ? 'btn-secondary' : 'btn-primary' }} btn-sm w-full">
                        {{ $user->active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
