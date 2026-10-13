<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class InventoryController extends Controller
{
    /**
     * Display stock levels for the store.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * inventory models are added. This is a single-location store, so
     * there is no per-branch breakdown.
     */
    public function index(): View
    {
        $stats = [
            ['label' => 'Tracked SKUs', 'value' => '1,284'],
            ['label' => 'Stock Value', 'value' => '₱2.4M'],
            ['label' => 'Low Stock', 'value' => '37'],
            ['label' => 'Out of Stock', 'value' => '9'],
        ];

        $categories = [
            ['name' => 'Engine Parts', 'skus' => 384, 'value' => 980000],
            ['name' => 'Electrical', 'skus' => 296, 'value' => 640000],
            ['name' => 'Fluids & Oils', 'skus' => 218, 'value' => 410000],
            ['name' => 'Brakes & Filters', 'skus' => 246, 'value' => 290000],
        ];

        $rows = [
            ['sku' => 'SPK-IRD-4', 'name' => 'Iridium Spark Plugs (set of 4)', 'on_hand' => 64, 'reserved' => 8, 'reorder' => 25, 'status' => 'In Stock'],
            ['sku' => 'FLT-AIR-HN', 'name' => 'Air Filter - Honda City', 'on_hand' => 38, 'reserved' => 3, 'reorder' => 18, 'status' => 'In Stock'],
            ['sku' => 'BLB-H4-LED', 'name' => 'H4 LED Headlight Bulb', 'on_hand' => 120, 'reserved' => 14, 'reorder' => 30, 'status' => 'In Stock'],
            ['sku' => 'OIL-5W30-1L', 'name' => 'Engine Oil 5W-30 (1L)', 'on_hand' => 4, 'reserved' => 0, 'reorder' => 20, 'status' => 'Low Stock'],
            ['sku' => 'BRK-PAD-TY', 'name' => 'Brake Pads - Toyota Vios', 'on_hand' => 6, 'reserved' => 2, 'reorder' => 15, 'status' => 'Low Stock'],
            ['sku' => 'BAT-NS60', 'name' => 'Battery NS60 12V', 'on_hand' => 2, 'reserved' => 0, 'reorder' => 10, 'status' => 'Low Stock'],
            ['sku' => 'CLT-TOY-13', 'name' => 'Clutch Kit - Toyota 1.3', 'on_hand' => 0, 'reserved' => 0, 'reorder' => 5, 'status' => 'Out of Stock'],
        ];

        return view('inventory.index', compact('stats', 'categories', 'rows'));
    }
}
