<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    /**
     * Hardcoded credentials for API access
     */
    protected $username = 'mskcomputers';
    protected $password = 'apiAccess2025';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get credentials from request
        $authHeader = $request->header('Authorization');
        
        // Check if Authorization header exists and starts with "Basic "
        if (!$authHeader || !str_starts_with($authHeader, 'Basic ')) {
            return $this->unauthorizedResponse();
        }
        
        // Extract and decode the credentials
        $encodedCredentials = substr($authHeader, 6);
        $decodedCredentials = base64_decode($encodedCredentials);
        
        // Check if credentials format is valid
        if (!str_contains($decodedCredentials, ':')) {
            return $this->unauthorizedResponse();
        }
        
        // Split username and password
        list($username, $password) = explode(':', $decodedCredentials, 2);
        
        // Verify against hardcoded credentials
        if ($username !== $this->username || $password !== $this->password) {
            return $this->unauthorizedResponse();
        }
        
        return $next($request);
    }
    
    /**
     * Return unauthorized response
     */
    private function unauthorizedResponse(): Response
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized. Please provide valid credentials.'
        ], 401)->header('WWW-Authenticate', 'Basic');
    }
}
