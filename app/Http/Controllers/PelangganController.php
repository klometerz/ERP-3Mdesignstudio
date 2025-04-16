<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
{
    $pelanggan = Pelanggan::paginate(10);

    return view('pelanggan.index', [
        'pelanggan' => $pelanggan,
        'title' => 'Data Pelanggan'
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
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'negara' => 'nullable|string|max:100',
            'kode_negara' => 'nullable|string|max:5',
            'status_pelanggan' => 'required|in:Aktif,Tidak Aktif',
        ]);
    
        $tahun = date('Y'); // Tahun sekarang, misal: 2025
        $bulan = date('m'); // Bulan sekarang, misal: 04
    
        // Hitung jumlah pelanggan di bulan ini
        $countThisMonth = \App\Models\Pelanggan::whereYear('created_at', $tahun)
                                                ->whereMonth('created_at', $bulan)
                                                ->count();
    
        $nextNumber = str_pad($countThisMonth + 1, 3, '0', STR_PAD_LEFT); // Format 001, 002, 003
    
        $kodePelanggan = "PEL-{$tahun}-{$bulan}-{$nextNumber}";
    
        $data = $request->only([
            'nama',
            'email',
            'telepon',
            'alamat',
            'kota',
            'provinsi',
            'zipcode',
            'negara',
            'kode_negara',
            'status_pelanggan'
        ]);
    
        $data['kode_pelanggan'] = $kodePelanggan;
        $data['is_dummy'] = false;
    
        \App\Models\Pelanggan::create($data);
    
        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan!');
    }
    



    public function show($id)
    {
        $pelanggan = Pelanggan::with('orders')->findOrFail($id);
        return view('pelanggan.show', [
            'pelanggan' => $pelanggan,
            'title' => 'Detail Pelanggan'
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
}
