@extends('layouts.app')

@section('title', 'Stock Movements')
@section('heading', 'Stock Movements')
@section('subheading', 'Audit trail of every stock change')

@section('content')
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :label="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-sm font-semibold text-slate-900">Movement Ledger</h2>
            <div class="flex items-center gap-2">
                <select class="rounded-lg border border-slate-300 py-2 pl-3 pr-8 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                    <option>All Types</option>
                    <option>Stock In</option>
                    <option>Stock Out</option>
                    <option>Adjustment</option>
                </select>
                <input type="date" value="2026-10-13"
                       class="rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Date &amp; Time</th>
                        <th class="px-5 py-3 font-medium">Product</th>
                        <th class="px-5 py-3 font-medium">Type</th>
                        <th class="px-5 py-3 text-right font-medium">Qty</th>
                        <th class="px-5 py-3 font-medium">Reference</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $tone = ['In' => 'emerald', 'Out' => 'sky', 'Adjust' => 'amber'];
                    @endphp
                    @foreach ($movements as $movement)
                        <tr class="hover:bg-slate-50/70">
                            <td class="whitespace-nowrap px-5 py-3 text-slate-500">{{ $movement['date'] }}</td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-slate-800">{{ $movement['product'] }}</p>
                                <p class="font-mono text-xs text-slate-400">{{ $movement['sku'] }}</p>
                            </td>
                            <td class="px-5 py-3"><x-status-badge :tone="$tone[$movement['type']]">{{ $movement['type'] }}</x-status-badge></td>
                            <td class="px-5 py-3 text-right font-medium {{ $movement['qty'] < 0 ? 'text-rose-600' : 'text-slate-800' }}">
                                {{ $movement['qty'] > 0 ? '+' : '' }}{{ $movement['qty'] }}
                            </td>
                            <td class="px-5 py-3 font-mono text-xs text-slate-500">{{ $movement['reference'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between border-t border-slate-200 px-5 py-3 text-xs text-slate-500">
            <span>Showing 1–7 of 4,210 records</span>
            <div class="flex items-center gap-1">
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Previous</button>
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Next</button>
            </div>
        </div>
    </div>
@endsection
