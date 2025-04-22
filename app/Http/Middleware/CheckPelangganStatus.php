<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPelangganStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Only apply to pelanggan
        if ($user && $user->role->name === 'pelanggan') {
            $pelanggan = $user->pelanggan;

            // Kalau pelanggan gak ada atau statusnya nonaktif
            if (!$pelanggan || $pelanggan->status_pelanggan !== 'Aktif') {
                auth()->logout();                             // Keluarin
                $request->session()->invalidate();            //  Bersihin session
                $request->session()->regenerateToken();       //  Ganti CSRF token

                return redirect()->route('login')->withErrors([
                    'email' => 'Akun Anda sudah tidak aktif. Silakan hubungi admin.'
                ]);
            }
        }

        return $next($request); // ✅ Lolos middleware
    }
}
