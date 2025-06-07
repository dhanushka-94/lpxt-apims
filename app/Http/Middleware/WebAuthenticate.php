<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class WebAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authenticated = $request->session()->get('authenticated');
        Log::info('WebAuthenticate middleware check. Is authenticated: ' . ($authenticated === true ? 'true' : 'false'));
        Log::info('Session data: ' . json_encode($request->session()->all()));
        
        if ($authenticated !== true) {
            Log::warning('Unauthenticated access attempt to: ' . $request->path());
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}
