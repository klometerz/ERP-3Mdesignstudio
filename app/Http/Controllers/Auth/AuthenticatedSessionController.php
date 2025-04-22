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
    public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = auth()->user();

    // Cek role null
    if (!$user->role) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withErrors([
            'email' => 'Akun tidak memiliki role valid.',
        ]);
    }

    if ($user->role->name === 'admin') {
        return redirect('/pelanggan');
    }
    if ($user->role->name === 'pelanggan') {
        return redirect()->route('pelanggan.profile'); // ✅ bukan pelanggan.show lagi
    }
    
    if ($user->role->name === 'pelanggan') {
        $pelanggan = $user->pelanggan;

        if (!$pelanggan || $pelanggan->status_pelanggan !== 'Aktif') {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda sudah tidak aktif.',
            ]);
        }

        return redirect()->route('pelanggan.show', $pelanggan->id);
    }

    return redirect('/dashboard');
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
