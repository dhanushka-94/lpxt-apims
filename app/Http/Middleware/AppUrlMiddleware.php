<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AppUrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the host from the request
        $host = $request->getHost();
        
        // Check for specific environments and set base URL accordingly
        if ($host === 'localhost' || $host === '127.0.0.1') {
            // Local development
            $scheme = $request->getScheme(); // http or https
            $port = $request->getPort();
            
            // Only append port if it's not the default port for the scheme
            if (($scheme === 'http' && $port != 80) || ($scheme === 'https' && $port != 443)) {
                $url = $scheme . '://' . $host . ':' . $port;
            } else {
                $url = $scheme . '://' . $host;
            }
            
            URL::forceRootUrl($url);
        } else if (str_contains($host, 'mskcomputers.com')) {
            // Production site with SSL
            URL::forceScheme('https');
            URL::forceRootUrl('https://' . $host);
        } else {
            // Default behavior for other environments
            URL::forceRootUrl($request->getScheme() . '://' . $host);
        }
        
        return $next($request);
    }
} 