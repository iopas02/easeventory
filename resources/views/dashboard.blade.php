@extends('layouts.app')

@section('title', 'Analytics')
@section('heading', 'Analytics Dashboard')
@section('subheading', 'Store performance overview')

@section('content')
    @php
        $iconPaths = [
            'cube' => 'm21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9',
            'banknotes' => 'M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z',
            'exclamation' => 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z',
            'x-circle' => 'm9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
        ];
    @endphp

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                        <p class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">{{ $stat['value'] }}</p>
                    </div>
                    <span class="grid h-10 w-10 place-items-center rounded-lg bg-indigo-50 text-indigo-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPaths[$stat['icon']] }}" />
                        </svg>
                    </span>
                </div>
                <div class="mt-3 flex items-center gap-2 text-xs">
                    <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 font-medium
                                 {{ $stat['trend'] === 'up' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                        <svg class="h-3 w-3 {{ $stat['trend'] === 'up' ? '' : 'rotate-180' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                        {{ $stat['change'] }}
                    </span>
                    <span class="text-slate-400">{{ $stat['note'] }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Charts --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm xl:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-slate-900">Sales Trend</h2>
                    <p class="text-xs text-slate-500">Monthly sales and order volume</p>
                </div>
                <span class="rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">Last 6 months</span>
            </div>
            <div class="mt-4 h-72"><canvas id="salesChart"></canvas></div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-slate-900">Sales by Category</h2>
            <p class="text-xs text-slate-500">Share of total revenue</p>
            <div class="mt-4 h-48"><canvas id="categoryChart"></canvas></div>
            <ul class="mt-5 space-y-2.5">
                @foreach ($categoryBreakdown as $cat)
                    <li class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2 text-slate-600">
                            <span class="h-2.5 w-2.5 rounded-full" style="background: {{ $cat['color'] }}"></span>
                            {{ $cat['name'] }}
                        </span>
                        <span class="font-medium text-slate-800">{{ $cat['value'] }}%</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Tables --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm xl:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <h2 class="text-sm font-semibold text-slate-900">Recent Transactions</h2>
                <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-500">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3 font-medium">Invoice</th>
                            <th class="px-5 py-3 font-medium">Customer</th>
                            <th class="px-5 py-3 font-medium">Items</th>
                            <th class="px-5 py-3 font-medium">Total</th>
                            <th class="px-5 py-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php
                            $statusStyles = [
                                'Paid' => 'bg-emerald-50 text-emerald-700',
                                'Pending' => 'bg-amber-50 text-amber-700',
                                'Refunded' => 'bg-rose-50 text-rose-700',
                            ];
                        @endphp
                        @foreach ($recentTransactions as $tx)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-5 py-3 font-medium text-slate-800">{{ $tx['id'] }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $tx['customer'] }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $tx['items'] }}</td>
                                <td class="px-5 py-3 font-medium text-slate-800">₱{{ number_format($tx['total']) }}</td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $statusStyles[$tx['status']] }}">
                                        {{ $tx['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <h2 class="text-sm font-semibold text-slate-900">Low Stock Alerts</h2>
                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700">{{ count($lowStock) }} items</span>
            </div>
            <ul class="divide-y divide-slate-100">
                @foreach ($lowStock as $item)
                    <li class="px-5 py-3.5">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-slate-800">{{ $item['name'] }}</p>
                                <p class="mt-0.5 text-xs text-slate-500">
                                    <span class="font-mono">{{ $item['sku'] }}</span> &middot; {{ $item['supplier'] }}
                                </p>
                            </div>
                            <span class="shrink-0 rounded-md bg-rose-50 px-2 py-0.5 text-xs font-semibold text-rose-700">
                                {{ $item['stock'] }} left
                            </span>
                        </div>
                        <div class="mt-2 h-1.5 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-amber-400"
                                 style="width: {{ max(6, min(100, ($item['stock'] / $item['reorder']) * 100)) }}%"></div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        const peso = (v) => '₱' + (v / 1000).toFixed(0) + 'k';
        const salesTrend = @json($salesTrend);
        const categoryBreakdown = @json($categoryBreakdown);

        new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: {
                labels: salesTrend.labels,
                datasets: [
                    {
                        label: 'Sales',
                        data: salesTrend.sales,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.12)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3,
                        pointBackgroundColor: '#6366f1',
                    },
                    {
                        label: 'Orders',
                        data: salesTrend.orders,
                        borderColor: '#22c55e',
                        backgroundColor: 'rgba(34, 197, 94, 0.0)',
                        tension: 0.4,
                        borderWidth: 2,
                        borderDash: [5, 5],
                        pointRadius: 3,
                        pointBackgroundColor: '#22c55e',
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, padding: 16 } },
                    tooltip: { callbacks: { label: (c) => `${c.dataset.label}: ${c.dataset.label === 'Sales' ? peso(c.parsed.y) : c.parsed.y}` } },
                },
                scales: {
                    y: { grid: { color: 'rgba(148, 163, 184, 0.15)' }, ticks: { callback: (v) => peso(v) } },
                    x: { grid: { display: false } },
                },
            },
        });

        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: categoryBreakdown.map((c) => c.name),
                datasets: [{
                    data: categoryBreakdown.map((c) => c.value),
                    backgroundColor: categoryBreakdown.map((c) => c.color),
                    borderWidth: 0,
                    hoverOffset: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: { legend: { display: false } },
            },
        });
    </script>
@endpush
