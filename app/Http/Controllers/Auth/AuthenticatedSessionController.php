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

        if ($user->status === 'Inactive') {
        Auth::logout();
            return back()->withErrors([
                'email' => 'Your account is inactive. Please contact the administrator.',
            ]);
        }

        if (in_array($user->role, ['admin', 'staff'])) {
            return redirect()->intended('/dashboard')->with('success', 'You are logged in successfully!');
        }

        return redirect()->intended('/residents/dashboard')->with('success', 'You are logged in successfully!');
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
        return redirect('/');
    }
}
