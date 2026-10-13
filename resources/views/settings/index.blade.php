@extends('layouts.app')

@section('title', 'Settings')
@section('heading', 'Settings')
@section('subheading', 'Store preferences and account')

@section('content')
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        {{-- Store profile --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm xl:col-span-2">
            <div class="border-b border-slate-200 px-5 py-4">
                <h2 class="text-sm font-semibold text-slate-900">Store Profile</h2>
                <p class="text-xs text-slate-500">Basic information about your business.</p>
            </div>
            <div class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Store name</label>
                    <input type="text" value="{{ auth()->user()->tenant?->name }}"
                           class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Contact number</label>
                    <input type="text" value="+63 917 555 0100"
                           class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" value="support@rjbr.test"
                           class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Address</label>
                    <textarea rows="2"
                              class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">123 Rizal Ave, Cebu City, Philippines</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Currency</label>
                    <select class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                        <option>PHP (₱)</option>
                        <option>USD ($)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Timezone</label>
                    <select class="mt-2 block w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                        <option>(GMT+8) Asia/Manila</option>
                        <option>(GMT+0) UTC</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-200 px-5 py-4">
                <button class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Cancel</button>
                <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Save Changes</button>
            </div>
        </div>

        {{-- Right column --}}
        <div class="space-y-6">
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-900">Notifications</h2>
                </div>
                <ul class="divide-y divide-slate-100">
                    @php
                        $prefs = [
                            ['label' => 'Low stock alerts', 'desc' => 'Notify when items hit reorder point', 'on' => true],
                            ['label' => 'Daily sales summary', 'desc' => 'Email a recap every evening', 'on' => true],
                            ['label' => 'New purchase orders', 'desc' => 'Alert on incoming orders', 'on' => false],
                        ];
                    @endphp
                    @foreach ($prefs as $pref)
                        <li class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div>
                                <p class="text-sm font-medium text-slate-800">{{ $pref['label'] }}</p>
                                <p class="text-xs text-slate-500">{{ $pref['desc'] }}</p>
                            </div>
                            <span class="inline-flex h-6 w-11 shrink-0 items-center rounded-full p-0.5 transition {{ $pref['on'] ? 'bg-indigo-600' : 'bg-slate-300' }}">
                                <span class="h-5 w-5 rounded-full bg-white shadow transition {{ $pref['on'] ? 'translate-x-5' : '' }}"></span>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-900">Account</h2>
                </div>
                <div class="space-y-4 p-5">
                    <div class="flex items-center gap-3">
                        <span class="grid h-11 w-11 place-items-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                            {{ Illuminate\Support\Str::of(auth()->user()->name)->substr(0, 1)->upper() }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <button class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Change Password</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg border border-rose-200 px-4 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
