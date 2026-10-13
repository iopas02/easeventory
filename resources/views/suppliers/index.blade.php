@extends('layouts.app')

@section('title', 'Suppliers')
@section('heading', 'Suppliers')
@section('subheading', 'Vendors and outstanding balances')

@section('content')
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :label="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="relative sm:w-72">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input type="text" placeholder="Search suppliers..."
                       class="w-full rounded-lg border border-slate-300 py-2 pl-9 pr-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            </div>
            <button class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Supplier
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Supplier</th>
                        <th class="px-5 py-3 font-medium">Contact</th>
                        <th class="px-5 py-3 text-right font-medium">Products</th>
                        <th class="px-5 py-3 text-right font-medium">Balance</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($suppliers as $supplier)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-indigo-50 text-sm font-semibold text-indigo-700">
                                        {{ Illuminate\Support\Str::of($supplier['name'])->substr(0, 1)->upper() }}
                                    </span>
                                    <div>
                                        <p class="font-medium text-slate-800">{{ $supplier['name'] }}</p>
                                        <p class="text-xs text-slate-400">{{ $supplier['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <p class="text-slate-700">{{ $supplier['contact'] }}</p>
                                <p class="text-xs text-slate-400">{{ $supplier['phone'] }}</p>
                            </td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $supplier['products'] }}</td>
                            <td class="px-5 py-3 text-right font-medium {{ $supplier['balance'] > 0 ? 'text-slate-800' : 'text-slate-400' }}">
                                ₱{{ number_format($supplier['balance']) }}
                            </td>
                            <td class="px-5 py-3">
                                <x-status-badge :tone="$supplier['status'] === 'Active' ? 'emerald' : 'slate'">{{ $supplier['status'] }}</x-status-badge>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
