<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function index()
    {
        return view('Login');
    }

    /**
     * Attempt to authenticate.
     */
    public function login(AuthRequest $request)
    {
        if (RateLimiter::tooManyAttempts($request->email, 5)) {
            $second = RateLimiter::availableIn($request->email);
            return redirect()->back()->with('error', "Your account has been locked! Please turn back in $second s");
        } // Lock login in 2 minutes if user login fail 5 times 

        if (!Auth::attempt($request->only(['email', 'password']), $request->filled('remember'))) {
            RateLimiter::hit($request->email, 120);

            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } // if wrong email or password, return error

        $request->session()->regenerate();

        return to_route('dashboard');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
