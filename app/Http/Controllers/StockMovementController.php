<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StockMovementController extends Controller
{
    /**
     * Display the stock movement ledger.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * StockMovement model is added.
     */
    public function index(): View
    {
        $stats = [
            ['label' => 'Received Today', 'value' => '312'],
            ['label' => 'Issued Today', 'value' => '184'],
            ['label' => 'Adjustments', 'value' => '6'],
            ['label' => 'Pending Receipts', 'value' => '11'],
        ];

        $movements = [
            ['date' => '2026-10-13 09:24', 'sku' => 'OIL-5W30-1L', 'product' => 'Engine Oil 5W-30 (1L)', 'type' => 'In', 'qty' => 48, 'reference' => 'PO-2041'],
            ['date' => '2026-10-13 09:02', 'sku' => 'BRK-PAD-TY', 'product' => 'Brake Pads - Toyota Vios', 'type' => 'Out', 'qty' => 4, 'reference' => 'INV-1042'],
            ['date' => '2026-10-13 08:47', 'sku' => 'BLB-H4-LED', 'product' => 'H4 LED Headlight Bulb', 'type' => 'Out', 'qty' => 2, 'reference' => 'INV-1041'],
            ['date' => '2026-10-12 17:15', 'sku' => 'SPK-IRD-4', 'product' => 'Iridium Spark Plugs (set of 4)', 'type' => 'In', 'qty' => 60, 'reference' => 'PO-2040'],
            ['date' => '2026-10-12 15:40', 'sku' => 'BAT-NS60', 'product' => 'Battery NS60 12V', 'type' => 'Adjust', 'qty' => -1, 'reference' => 'Damaged'],
            ['date' => '2026-10-12 11:22', 'sku' => 'FLT-AIR-HN', 'product' => 'Air Filter - Honda City', 'type' => 'Out', 'qty' => 3, 'reference' => 'INV-1038'],
            ['date' => '2026-10-11 16:05', 'sku' => 'WSH-WIP-24', 'product' => 'Windshield Wiper 24"', 'type' => 'In', 'qty' => 40, 'reference' => 'PO-2039'],
        ];

        return view('stock-movements.index', compact('stats', 'movements'));
    }
}
