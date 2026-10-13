<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display available reports.
     *
     * NOTE: Placeholder data — wire these up to real exports later.
     */
    public function index(): View
    {
        $reports = [
            ['name' => 'Sales Summary', 'description' => 'Revenue and transactions by day, week, or month.', 'tone' => 'indigo', 'updated' => 'Today, 09:00'],
            ['name' => 'Inventory Valuation', 'description' => 'Stock on hand valued at cost and retail price.', 'tone' => 'emerald', 'updated' => 'Today, 08:30'],
            ['name' => 'Low Stock Report', 'description' => 'Items at or below reorder point, grouped by supplier.', 'tone' => 'amber', 'updated' => 'Today, 08:30'],
            ['name' => 'Purchase Report', 'description' => 'Orders placed and received within a date range.', 'tone' => 'sky', 'updated' => 'Yesterday, 18:00'],
            ['name' => 'Stock Movement Ledger', 'description' => 'Full audit trail of every stock in, out, and adjustment.', 'tone' => 'slate', 'updated' => 'Live'],
            ['name' => 'Supplier Performance', 'description' => 'Lead times, fill rate, and order accuracy per supplier.', 'tone' => 'rose', 'updated' => 'Yesterday, 18:00'],
        ];

        return view('reports.index', compact('reports'));
    }
}
