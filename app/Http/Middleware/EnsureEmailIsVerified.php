<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         if (Auth::check() && Auth::user()->email_verified_at === null) {
            return redirect()->route('Confirm-OTP')->with('return_message', [
                'status_code' => 403,
                'status' => false,
                'message' => 'Please verify your email first.',
            ]);
        }

        return $next($request);
    }
}
