<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index(Request $request)
{
    $query = Pelanggan::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('nama', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('telepon', 'like', "%{$search}%")
              ->orWhere('kota', 'like', "%{$search}%");
    }

    $pelanggan = $query->paginate(10)->withQueryString();

    return view('pelanggan.index', [
        'pelanggan' => $pelanggan,
        'title' => 'Data Pelanggan',
    ]);
    
}


    public function create()
    {
        return view('pelanggan.create', [
            'title' => 'Tambah Pelanggan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'negara' => 'nullable|string|max:100',
            'kode_negara' => 'nullable|string|max:5',
            'status_pelanggan' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Generate kode pelanggan unik
        $tahun = date('Y');
        $bulan = date('m');
        $countThisMonth = Pelanggan::whereYear('created_at', $tahun)
                                   ->whereMonth('created_at', $bulan)
                                   ->count();
        $nextNumber = str_pad($countThisMonth + 1, 3, '0', STR_PAD_LEFT);
        $kodePelanggan = "PEL-{$tahun}-{$bulan}-{$nextNumber}";

        // Generate password & hash
        $plainPassword = Str::random(8);
        $hashedPassword = Hash::make($plainPassword);

        // Buat akun user
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role_id' => 2,
        ]);

        // Buat data pelanggan terhubung user_id
        $pelanggan = Pelanggan::create([
            'user_id' => $user->id,
            'kode_pelanggan' => $kodePelanggan,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'zipcode' => $request->zipcode,
            'negara' => $request->negara,
            'kode_negara' => $request->kode_negara,
            'status_pelanggan' => $request->status_pelanggan,
            'plain_password' => $plainPassword,
            'is_dummy' => false,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan & akun berhasil dibuat. Password: ' . $plainPassword);
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::with('orders')->findOrFail($id);

        if (auth()->user()->role->name === 'admin') {
            return view('pelanggan.show', [
                'pelanggan' => $pelanggan,
                'title' => 'Detail Pelanggan'
            ]);
        }

        if (auth()->user()->role->name === 'pelanggan') {
            if (auth()->user()->id !== $pelanggan->user_id) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }

            return view('pelanggan.show', [
                'pelanggan' => $pelanggan,
                'title' => 'Profil Saya'
            ]);
        }

        abort(403, 'Akses ditolak.');
    }

    public function myProfile()
    {
        $user = auth()->user();
        $pelanggan = $user->pelanggan;

        if (!$pelanggan || $pelanggan->status_pelanggan !== 'Aktif') {
            abort(403, 'Akses tidak diizinkan.');
        }

        return view('pelanggan.show', [
            'pelanggan' => $pelanggan,
            'title' => 'Profil Saya'
        ]);
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', [
            'pelanggan' => $pelanggan,
            'title' => 'Edit Pelanggan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'status_pelanggan' => 'required',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus!');
    }

    public function clearPassword($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update(['plain_password' => null]);

        return redirect()->route('pelanggan.show', $id)->with('success', 'Password akun disembunyikan.');
    }
}
