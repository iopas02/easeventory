<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display sales and invoices.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * Sale model is added.
     */
    public function index(): View
    {
        $stats = [
            ['label' => "Today's Sales", 'value' => '₱46,250'],
            ['label' => 'Transactions', 'value' => '23'],
            ['label' => 'Items Sold', 'value' => '148'],
            ['label' => 'Avg. Order', 'value' => '₱2,011'],
        ];

        $sales = [
            ['invoice' => 'INV-1042', 'customer' => 'Jose Dela Cruz', 'date' => '2026-10-13', 'items' => 6, 'total' => 18450, 'payment' => 'Cash', 'status' => 'Paid'],
            ['invoice' => 'INV-1041', 'customer' => 'Mila Santos', 'date' => '2026-10-13', 'items' => 2, 'total' => 3200, 'payment' => 'GCash', 'status' => 'Paid'],
            ['invoice' => 'INV-1040', 'customer' => 'Ramon Reyes', 'date' => '2026-10-12', 'items' => 12, 'total' => 42800, 'payment' => 'Bank', 'status' => 'Pending'],
            ['invoice' => 'INV-1039', 'customer' => 'Walk-in Customer', 'date' => '2026-10-12', 'items' => 1, 'total' => 850, 'payment' => 'Cash', 'status' => 'Paid'],
            ['invoice' => 'INV-1038', 'customer' => 'Ana Villanueva', 'date' => '2026-10-11', 'items' => 4, 'total' => 9750, 'payment' => 'Card', 'status' => 'Refunded'],
            ['invoice' => 'INV-1037', 'customer' => 'Ben Aquino', 'date' => '2026-10-11', 'items' => 7, 'total' => 15600, 'payment' => 'Cash', 'status' => 'Paid'],
        ];

        return view('sales.index', compact('stats', 'sales'));
    }
}
