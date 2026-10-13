<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     *
     * NOTE: Static form — persist these values once the settings store
     * is implemented.
     */
    public function index(): View
    {
        return view('settings.index');
    }
}
