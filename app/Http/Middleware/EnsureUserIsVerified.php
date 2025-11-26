<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if ($user && $user->resident()) {
            if (!$user->resident || !$user->resident->is_approved) {
                Auth::logout();
                
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is pending admin verification. Please wait for approval.',
                ]);
            }
        }

        return $next($request);
    }
}
