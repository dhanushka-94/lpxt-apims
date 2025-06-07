<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApiDocumentationController extends Controller
{
    /**
     * Show API documentation page
     * 
     * This page is already protected by the web.auth middleware
     * but we add an extra check here for security
     */
    public function index(Request $request)
    {
        // Double check authentication for critical pages
        if ($request->session()->get('authenticated') !== true) {
            \Log::warning('Unauthenticated access attempt to API documentation: ' . $request->ip());
            return redirect()->route('login');
        }
        
        return view('api.documentation');
    }
} 