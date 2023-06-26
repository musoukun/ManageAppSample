<?php

namespace App\Http\Controllers\ManageAppAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAppAuth\manageappLoginRequest;
use App\Providers\RouteServiceProvider;
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
        return view('manageapp.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(manageappLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::MANAGEAPP_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('manageapp')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('manageapp/login');
    }
}
