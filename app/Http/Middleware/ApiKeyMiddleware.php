<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Hardcoded API Key
     * This is a static key for simplicity
     * In a production environment, consider more secure options
     */
    protected $apiKey = 'msk-api-5f4dcc3b5aa765d61d8327deb882cf99';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try to get API key from header or query parameter
        $apiKey = $request->header('X-API-KEY') ?? $request->query('api_key');
        
        // If no API key is provided, return unauthorized response
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key is missing. Please provide a valid API key.'
            ], 401);
        }
        
        // Validate against hardcoded API key
        if ($apiKey !== $this->apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid API key'
            ], 401);
        }
        
        // Add API key to the request for later use if needed
        $request->attributes->set('api_key', $apiKey);
        
        return $next($request);
    }
}
