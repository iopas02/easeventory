<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the superadmin login form.
     */
    public function showLogin(): View
    {
        return view('superadmin.auth.login');
    }

    /**
     * Authenticate a superadmin using the dedicated guard.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('superadmin')->attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'The provided credentials do not match our records.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('superadmin.users.index'));
    }

    /**
     * Log the superadmin out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}
