<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    /**
     * Display purchase orders.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * PurchaseOrder model is added.
     */
    public function index(): View
    {
        $stats = [
            ['label' => 'Open Orders', 'value' => '11'],
            ['label' => 'Awaiting Receipt', 'value' => '6'],
            ['label' => 'Received (MTD)', 'value' => '34'],
            ['label' => 'Open Value', 'value' => '₱438K'],
        ];

        $orders = [
            ['po' => 'PO-2041', 'supplier' => 'PetroMax Distributors', 'date' => '2026-10-10', 'expected' => '2026-10-15', 'items' => 8, 'total' => 96500, 'status' => 'Ordered'],
            ['po' => 'PO-2040', 'supplier' => 'IgniteCo Ignition Parts', 'date' => '2026-10-09', 'expected' => '2026-10-12', 'items' => 4, 'total' => 58800, 'status' => 'Received'],
            ['po' => 'PO-2039', 'supplier' => 'ClearView Accessories', 'date' => '2026-10-08', 'expected' => '2026-10-11', 'items' => 3, 'total' => 13600, 'status' => 'Received'],
            ['po' => 'PO-2038', 'supplier' => 'VoltPower Battery Co.', 'date' => '2026-10-07', 'expected' => '2026-10-14', 'items' => 6, 'total' => 84000, 'status' => 'Partial'],
            ['po' => 'PO-2037', 'supplier' => 'AutoPro Brake Systems', 'date' => '2026-10-05', 'expected' => '2026-10-09', 'items' => 10, 'total' => 72500, 'status' => 'Received'],
            ['po' => 'PO-2042', 'supplier' => 'FilterPro Filters Inc.', 'date' => '2026-10-13', 'expected' => '2026-10-18', 'items' => 5, 'total' => 23400, 'status' => 'Draft'],
        ];

        return view('purchase-orders.index', compact('stats', 'orders'));
    }
}
