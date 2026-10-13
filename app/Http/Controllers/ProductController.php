<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product catalog.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * Product model and migration are added.
     */
    public function index(): View
    {
        $stats = [
            ['label' => 'Total Products', 'value' => '1,284'],
            ['label' => 'Active', 'value' => '1,197'],
            ['label' => 'Low Stock', 'value' => '37'],
            ['label' => 'Discontinued', 'value' => '50'],
        ];

        $categories = ['All Categories', 'Engine Parts', 'Electrical', 'Fluids & Oils', 'Brakes', 'Filters', 'Accessories'];

        $products = [
            ['sku' => 'OIL-5W30-1L', 'name' => 'Engine Oil 5W-30 (1L)', 'category' => 'Fluids & Oils', 'price' => 480, 'stock' => 4, 'supplier' => 'PetroMax', 'status' => 'Low'],
            ['sku' => 'BRK-PAD-TY', 'name' => 'Brake Pads - Toyota Vios', 'category' => 'Brakes', 'price' => 1250, 'stock' => 6, 'supplier' => 'AutoPro', 'status' => 'Low'],
            ['sku' => 'BAT-NS60', 'name' => 'Battery NS60 12V', 'category' => 'Electrical', 'price' => 4200, 'stock' => 2, 'supplier' => 'VoltPower', 'status' => 'Low'],
            ['sku' => 'SPK-IRD-4', 'name' => 'Iridium Spark Plugs (set of 4)', 'category' => 'Engine Parts', 'price' => 980, 'stock' => 64, 'supplier' => 'IgniteCo', 'status' => 'Active'],
            ['sku' => 'FLT-AIR-HN', 'name' => 'Air Filter - Honda City', 'category' => 'Filters', 'price' => 520, 'stock' => 38, 'supplier' => 'FilterPro', 'status' => 'Active'],
            ['sku' => 'BLB-H4-LED', 'name' => 'H4 LED Headlight Bulb', 'category' => 'Electrical', 'price' => 890, 'stock' => 120, 'supplier' => 'VoltPower', 'status' => 'Active'],
            ['sku' => 'CLT-TOY-13', 'name' => 'Clutch Kit - Toyota 1.3', 'category' => 'Engine Parts', 'price' => 6500, 'stock' => 0, 'supplier' => 'DriveLine', 'status' => 'Out'],
            ['sku' => 'WSH-WIP-24', 'name' => 'Windshield Wiper 24"', 'category' => 'Accessories', 'price' => 340, 'stock' => 96, 'supplier' => 'ClearView', 'status' => 'Active'],
        ];

        return view('products.index', compact('stats', 'categories', 'products'));
    }
}
