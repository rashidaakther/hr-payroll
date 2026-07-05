<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'email.exists' => 'This email address is not registered in our records.',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Single Line Dynamic Role Path Compute
            $userRole = Auth::user()->role;
            $redirectUrl = $userRole === 'admin'
                ? route('admin.dashboard')
                : ($userRole === 'employee' ? route('employee.dashboard') : route('login'));

            // Flash message mapping via standard redirection logic to bypass 'Guest' middleware forces
            return redirect()->back()->with([
                'login_success' => 'Login successful! Redirecting to your dashboard...',
                'redirect_url'  => $redirectUrl
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    protected function redirectBasedOnRole($user)
    {
        return redirect()->to($this->getRedirectUrl($user));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
