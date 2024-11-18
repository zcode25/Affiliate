<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah pengguna adalah affiliate dan statusnya 'pending' atau 'reject'
            if ($user->affiliate && $user->affiliate->status === 'pending') {
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is still pending approval and cannot log in at this time.',
                ]);
            } elseif ($user->affiliate && $user->affiliate->status === 'reject') {
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Your account has been rejected and cannot log in.',
                ]);
            }

            $request->session()->regenerate();

            if($user->role == 'Admin') {
                return redirect()->intended(route('dashboardAdmin', absolute: false));
            } else {
                return redirect()->intended(route('dashboard', absolute: false));
            }
        }

        // Jika kredensial tidak valid
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
