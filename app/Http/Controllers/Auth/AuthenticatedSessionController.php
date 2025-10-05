<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
        return redirect()->intended('/admin/dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->intended('/staff/dashboard');
        }

        return redirect()->intended('/residents/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $role = $user ? $user->role : null;

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on role
        if ($role === 'admin') {
            return redirect('/admin/login');
        } elseif ($role === 'staff') {
            return redirect('/staff/login');
        } else {
            return redirect('/');
        }
    }
}
