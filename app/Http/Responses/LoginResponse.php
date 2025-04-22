<?php

namespace App\Http\Responses;

//use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if (!$user || !$user->role) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda belum memiliki role yang valid.'
            ]);
        }

        if ($user->role->name === 'admin') {
            return redirect('/pelanggan');
        }

        if ($user->role->name === 'pelanggan') {
            $pelanggan = $user->pelanggan;

            if (!$pelanggan || $pelanggan->status_pelanggan !== 'Aktif') {
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akun Anda tidak aktif. Silakan hubungi admin.'
                ]);
            }

            return redirect()->route('pelanggan.show', $pelanggan->id);
        }

        return redirect('/dashboard');
    }
}
