<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    private $username = 'mskcomputers';
    private $password = 'apiAccess2025';
    private $rememberTokenName = 'msk_api_remember_token';
    private $rememberToken = 'b5c99eb5c9f45a34aa8b1e71b5cdac3b'; // This would normally be more secure
    
    /**
     * Show login form
     */
    public function showLoginForm(Request $request)
    {
        // Check if user is already authenticated
        if (Session::get('authenticated') === true) {
            return redirect('/');
        }
        
        // Check for remember me cookie
        $rememberToken = $request->cookie($this->rememberTokenName);
        if ($rememberToken && $rememberToken === $this->rememberToken) {
            // Set authenticated session
            $request->session()->put('authenticated', true);
            $request->session()->save();
            
            return redirect('/');
        }
        
        return view('auth.login');
    }
    
    /**
     * Handle login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if ($request->username === $this->username && $request->password === $this->password) {
            // Set authenticated session
            $request->session()->put('authenticated', true);
            $request->session()->save();
            
            // Handle remember me
            $response = redirect()->intended('/');
            if ($request->has('remember')) {
                $response->cookie(
                    $this->rememberTokenName, 
                    $this->rememberToken, 
                    43200 // 30 days in minutes
                );
            }
            
            // Debug: verify session was set
            \Log::info('User authenticated. Session value: ' . $request->session()->get('authenticated'));
            \Log::info('Remember me: ' . ($request->has('remember') ? 'enabled' : 'disabled'));
            
            return $response;
        }
        
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }
    
    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        $request->session()->forget('authenticated');
        $request->session()->save();
        
        \Log::info('User logged out. Session cleared.');
        
        $response = redirect()->route('login');
        $response->cookie($this->rememberTokenName, '', -1); // Expire the cookie
        
        return $response;
    }
}
