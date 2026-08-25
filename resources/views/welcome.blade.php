@extends('layouts.app')

@section('title', 'Task & Budget Manager')

@section('content')
    <!-- Hero -->
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-center">
            <span class="badge-green mb-4">Free while you're testing it out</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight text-balance">
                Making task management <span class="text-emerald-600">more human</span>
            </h1>
            <p class="mt-5 text-lg text-slate-600 max-w-2xl mx-auto">
                Plan projects, track tasks and subtasks, and keep your monthly budget in check —
                all in one simple, uncluttered workspace.
            </p>
            <div class="mt-8 flex items-center justify-center gap-3">
                <a href="{{ route('register') }}" class="btn-primary px-6 py-3 text-base">Try it for free</a>
                <a href="{{ route('login') }}" class="btn-secondary px-6 py-3 text-base">Log in</a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900">Everything you need, nothing you don't</h2>
                <p class="mt-3 text-slate-500 max-w-xl mx-auto">A small set of tools that work well together.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card card-body text-center">
                    <div class="mx-auto w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Clean organization</h3>
                    <p class="mt-2 text-sm text-slate-500">Projects break down into tasks and subtasks, so nothing gets lost in a single flat list.</p>
                </div>
                <div class="card card-body text-center">
                    <div class="mx-auto w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Budget tracking</h3>
                    <p class="mt-2 text-sm text-slate-500">Set a monthly budget per category and see exactly what's left — or where you've overspent.</p>
                </div>
                <div class="card card-body text-center">
                    <div class="mx-auto w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Built for speed</h3>
                    <p class="mt-2 text-sm text-slate-500">No clutter, no unnecessary steps — just the tools you need to get through your day.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-emerald-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-white">Ready to get organized?</h2>
            <p class="mt-3 text-emerald-100">Create a free account and set up your first project in under a minute.</p>
            <a href="{{ route('register') }}" class="btn-primary bg-white text-emerald-700 hover:bg-emerald-50 mt-6 inline-flex px-6 py-3 text-base">
                Create your account
            </a>
        </div>
    </section>
@endsection
