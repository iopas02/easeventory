<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display the supplier directory.
     *
     * NOTE: Placeholder data — replace with an Eloquent query once the
     * Supplier model is added.
     */
    public function index(): View
    {
        $stats = [
            ['label' => 'Active Suppliers', 'value' => '28'],
            ['label' => 'Purchase Value (MTD)', 'value' => '₱612K'],
            ['label' => 'Open Orders', 'value' => '11'],
            ['label' => 'On-time Delivery', 'value' => '94%'],
        ];

        $suppliers = [
            ['name' => 'PetroMax Distributors', 'contact' => 'Carlos Tan', 'email' => 'sales@petromax.test', 'phone' => '+63 917 555 0101', 'products' => 42, 'balance' => 128400, 'status' => 'Active'],
            ['name' => 'VoltPower Battery Co.', 'contact' => 'Grace Lim', 'email' => 'orders@voltpower.test', 'phone' => '+63 917 555 0102', 'products' => 18, 'balance' => 86500, 'status' => 'Active'],
            ['name' => 'AutoPro Brake Systems', 'contact' => 'Miguel Reyes', 'email' => 'miguel@autopro.test', 'phone' => '+63 917 555 0103', 'products' => 27, 'balance' => 0, 'status' => 'Active'],
            ['name' => 'IgniteCo Ignition Parts', 'contact' => 'Sofia Uy', 'email' => 'hello@igniteco.test', 'phone' => '+63 917 555 0104', 'products' => 15, 'balance' => 42300, 'status' => 'Active'],
            ['name' => 'FilterPro Filters Inc.', 'contact' => 'David Ong', 'email' => 'sales@filterpro.test', 'phone' => '+63 917 555 0105', 'products' => 33, 'balance' => 0, 'status' => 'Active'],
            ['name' => 'DriveLine Transmission', 'contact' => 'Rachel Go', 'email' => 'info@driveline.test', 'phone' => '+63 917 555 0106', 'products' => 12, 'balance' => 19750, 'status' => 'Inactive'],
        ];

        return view('suppliers.index', compact('stats', 'suppliers'));
    }
}
