@extends('layouts.app')

@section('title', 'Sales')
@section('heading', 'Sales')
@section('subheading', 'Invoices and transactions')

@section('content')
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :label="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-sm font-semibold text-slate-900">Recent Sales</h2>
            <div class="flex items-center gap-2">
                <input type="date" value="2026-10-13"
                       class="rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                <button class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Sale
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Invoice</th>
                        <th class="px-5 py-3 font-medium">Customer</th>
                        <th class="px-5 py-3 font-medium">Date</th>
                        <th class="px-5 py-3 text-right font-medium">Items</th>
                        <th class="px-5 py-3 font-medium">Payment</th>
                        <th class="px-5 py-3 text-right font-medium">Total</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $tone = ['Paid' => 'emerald', 'Pending' => 'amber', 'Refunded' => 'rose'];
                    @endphp
                    @foreach ($sales as $sale)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-3 font-mono text-xs font-medium text-slate-800">{{ $sale['invoice'] }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $sale['customer'] }}</td>
                            <td class="whitespace-nowrap px-5 py-3 text-slate-500">{{ $sale['date'] }}</td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $sale['items'] }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $sale['payment'] }}</td>
                            <td class="px-5 py-3 text-right font-medium text-slate-800">₱{{ number_format($sale['total']) }}</td>
                            <td class="px-5 py-3"><x-status-badge :tone="$tone[$sale['status']]">{{ $sale['status'] }}</x-status-badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between border-t border-slate-200 px-5 py-3 text-xs text-slate-500">
            <span>Showing 1–6 of 3,842 invoices</span>
            <div class="flex items-center gap-1">
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Previous</button>
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Next</button>
            </div>
        </div>
    </div>
@endsection
