@extends('layouts.app')

@section('title', 'Inventory')
@section('heading', 'Inventory')
@section('subheading', 'Stock levels and valuation')

@section('content')
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :label="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($categories as $category)
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-800">{{ $category['name'] }}</p>
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-slate-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-xl font-semibold tracking-tight text-slate-900">₱{{ number_format($category['value']) }}</p>
                <p class="mt-1 text-xs text-slate-500">{{ number_format($category['skus']) }} SKUs</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
            <h2 class="text-sm font-semibold text-slate-900">Stock on Hand</h2>
            <button class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Product</th>
                        <th class="px-5 py-3 text-right font-medium">On Hand</th>
                        <th class="px-5 py-3 text-right font-medium">Reserved</th>
                        <th class="px-5 py-3 text-right font-medium">Available</th>
                        <th class="px-5 py-3 text-right font-medium">Reorder Pt.</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $tone = ['In Stock' => 'emerald', 'Low Stock' => 'amber', 'Out of Stock' => 'rose'];
                    @endphp
                    @foreach ($rows as $row)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-3">
                                <p class="font-medium text-slate-800">{{ $row['name'] }}</p>
                                <p class="font-mono text-xs text-slate-400">{{ $row['sku'] }}</p>
                            </td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $row['on_hand'] }}</td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $row['reserved'] }}</td>
                            <td class="px-5 py-3 text-right font-medium text-slate-800">{{ $row['on_hand'] - $row['reserved'] }}</td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $row['reorder'] }}</td>
                            <td class="px-5 py-3"><x-status-badge :tone="$tone[$row['status']]">{{ $row['status'] }}</x-status-badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
