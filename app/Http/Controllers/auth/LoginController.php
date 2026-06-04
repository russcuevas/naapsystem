<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function LoginPage()
    {
        if (Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.dashboard.page');
        }
        return view('auth.login');
    }

    public function LoginRequest(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::guard('superadmin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('superadmin.dashboard.page'))->with('swal_success', 'Welcome!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function LogoutRequest(Request $request)
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login.page')->with('swal_success', 'Logged out successfully!');
    }
}
