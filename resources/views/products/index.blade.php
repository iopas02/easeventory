@extends('layouts.app')

@section('title', 'Products')
@section('heading', 'Products')
@section('subheading', 'Manage your product catalog')

@section('content')
    <div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card :label="$stat['label']" :value="$stat['value']" />
        @endforeach
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative sm:w-72">
                    <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" placeholder="Search products or SKU..."
                           class="w-full rounded-lg border border-slate-300 py-2 pl-9 pr-3 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                </div>
                <select class="rounded-lg border border-slate-300 py-2 pl-3 pr-8 text-sm text-slate-600 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                    @foreach ($categories as $category)
                        <option>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <button class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Product
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-medium">Product</th>
                        <th class="px-5 py-3 font-medium">Category</th>
                        <th class="px-5 py-3 font-medium">Supplier</th>
                        <th class="px-5 py-3 text-right font-medium">Price</th>
                        <th class="px-5 py-3 text-right font-medium">Stock</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $tone = ['Active' => 'emerald', 'Low' => 'amber', 'Out' => 'rose', 'Discontinued' => 'slate'];
                    @endphp
                    @foreach ($products as $product)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-3">
                                <p class="font-medium text-slate-800">{{ $product['name'] }}</p>
                                <p class="font-mono text-xs text-slate-400">{{ $product['sku'] }}</p>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $product['category'] }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $product['supplier'] }}</td>
                            <td class="px-5 py-3 text-right font-medium text-slate-800">₱{{ number_format($product['price']) }}</td>
                            <td class="px-5 py-3 text-right text-slate-600">{{ $product['stock'] }}</td>
                            <td class="px-5 py-3"><x-status-badge :tone="$tone[$product['status']]">{{ $product['status'] }}</x-status-badge></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between border-t border-slate-200 px-5 py-3 text-xs text-slate-500">
            <span>Showing 1–8 of 1,284 products</span>
            <div class="flex items-center gap-1">
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Previous</button>
                <button class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">Next</button>
            </div>
        </div>
    </div>
@endsection
