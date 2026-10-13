@extends('layouts.superadmin')

@section('title', 'Edit User')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="mb-5">
            <h1 class="text-lg font-semibold text-slate-900">Edit User</h1>
            <p class="text-sm text-slate-500">{{ $user->email }}</p>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
            @if ($errors->any())
                <div class="mb-5 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('superadmin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')
                @include('superadmin.users._form')

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                    <a href="{{ route('superadmin.users.index') }}"
                       class="rounded-lg px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
