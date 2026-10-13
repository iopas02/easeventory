<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Superadmin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="h-full bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="flex min-h-full flex-col">
        <header class="sticky top-0 z-20 border-b border-slate-800 bg-slate-900">
            <div class="mx-auto flex h-16 w-full max-w-6xl items-center gap-4 px-4 lg:px-8">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-indigo-500 text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </span>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold text-white">Superadmin Console</p>
                        <p class="text-[11px] text-slate-400">Platform administration</p>
                    </div>
                </div>

                <nav class="ml-6 hidden items-center gap-1 sm:flex">
                    <a href="{{ route('superadmin.users.index') }}"
                       class="rounded-lg px-3 py-2 text-sm font-medium transition
                              {{ request()->routeIs('superadmin.users.*') ? 'bg-indigo-500/15 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                        Users
                    </a>
                </nav>

                <div class="ml-auto flex items-center gap-3 border-l border-white/10 pl-3">
                    <div class="text-right leading-tight">
                        <p class="text-sm font-medium text-white">{{ auth('superadmin')->user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ auth('superadmin')->user()->username }}</p>
                    </div>
                    <form method="POST" action="{{ route('superadmin.logout') }}">
                        @csrf
                        <button type="submit" title="Sign out"
                                class="rounded-lg p-2 text-slate-400 transition hover:bg-rose-500/10 hover:text-rose-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-6 lg:px-8">
            @if (session('status'))
                <div class="mb-5 flex items-center gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-slate-200 px-4 py-4 text-center text-xs text-slate-400 lg:px-8">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
