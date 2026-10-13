<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the analytics dashboard.
     *
     * NOTE: All data below is static placeholder data so the UI can be
     * built and reviewed before the inventory models are wired up.
     */
    public function index(): View
    {
        $stats = [
            [
                'label' => 'Total Products',
                'value' => '1,284',
                'change' => '+4.6%',
                'trend' => 'up',
                'icon' => 'cube',
                'note' => 'vs. last month',
            ],
            [
                'label' => 'Stock Value',
                'value' => '₱2.4M',
                'change' => '+7.2%',
                'trend' => 'up',
                'icon' => 'banknotes',
                'note' => 'vs. last month',
            ],
            [
                'label' => 'Low Stock Items',
                'value' => '37',
                'change' => '+12',
                'trend' => 'down',
                'icon' => 'exclamation',
                'note' => 'needs restocking',
            ],
            [
                'label' => 'Out of Stock',
                'value' => '9',
                'change' => '-3',
                'trend' => 'up',
                'icon' => 'x-circle',
                'note' => 'vs. last week',
            ],
        ];

        $salesTrend = [
            'labels' => ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            'sales' => [182000, 214500, 201000, 268000, 249500, 297400],
            'orders' => [120, 145, 132, 176, 168, 201],
        ];

        $categoryBreakdown = [
            ['name' => 'Engine Parts', 'value' => 42, 'color' => '#6366f1'],
            ['name' => 'Electrical', 'value' => 23, 'color' => '#22c55e'],
            ['name' => 'Fluids & Oils', 'value' => 18, 'color' => '#f59e0b'],
            ['name' => 'Accessories', 'value' => 11, 'color' => '#06b6d4'],
            ['name' => 'Others', 'value' => 6, 'color' => '#94a3b8'],
        ];

        $recentTransactions = [
            ['id' => 'INV-1042', 'customer' => 'Jose Dela Cruz', 'items' => 6, 'total' => 18450, 'status' => 'Paid', 'date' => '2026-10-13'],
            ['id' => 'INV-1041', 'customer' => 'Mila Santos', 'items' => 2, 'total' => 3200, 'status' => 'Paid', 'date' => '2026-10-13'],
            ['id' => 'INV-1040', 'customer' => 'Ramon Reyes', 'items' => 12, 'total' => 42800, 'status' => 'Pending', 'date' => '2026-10-12'],
            ['id' => 'INV-1039', 'customer' => 'Walk-in Customer', 'items' => 1, 'total' => 850, 'status' => 'Paid', 'date' => '2026-10-12'],
            ['id' => 'INV-1038', 'customer' => 'Ana Villanueva', 'items' => 4, 'total' => 9750, 'status' => 'Refunded', 'date' => '2026-10-11'],
        ];

        $lowStock = [
            ['sku' => 'OIL-5W30-1L', 'name' => 'Engine Oil 5W-30 (1L)', 'stock' => 4, 'reorder' => 20, 'supplier' => 'PetroMax'],
            ['sku' => 'BRK-PAD-TY', 'name' => 'Brake Pads - Toyota Vios', 'stock' => 6, 'reorder' => 15, 'supplier' => 'AutoPro'],
            ['sku' => 'BAT-NS60', 'name' => 'Battery NS60 12V', 'stock' => 2, 'reorder' => 10, 'supplier' => 'VoltPower'],
            ['sku' => 'SPK-IRD-4', 'name' => 'Iridium Spark Plugs (set of 4)', 'stock' => 8, 'reorder' => 25, 'supplier' => 'IgniteCo'],
            ['sku' => 'FLT-AIR-HN', 'name' => 'Air Filter - Honda', 'stock' => 5, 'reorder' => 18, 'supplier' => 'FilterPro'],
        ];

        return view('dashboard', compact(
            'stats',
            'salesTrend',
            'categoryBreakdown',
            'recentTransactions',
            'lowStock',
        ));
    }
}
