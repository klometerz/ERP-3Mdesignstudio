<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
   // public function index()
    //{
       // $pegawai = Pegawai::all();
       // return view('pegawai.index', compact('pegawai'));
   // }

   //search bar
   public function index(Request $request)
{
    $query = Pegawai::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('jabatan', 'like', '%' . $request->search . '%')
              ->orWhere('alamat', 'like', '%' . $request->search . '%');
    }

    $pegawai = $query->paginate(10)->withQueryString();

    return view('pegawai.index', compact('pegawai'));
}


    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate');
    }

    public function destroy(Pegawai $pegawai)
{
    $nama = $pegawai->nama; // 🔥 Simpan nama dulu sebelum dihapus
    $pegawai->delete();

    return redirect()->route('pegawai.index')
        ->with('success', "Pegawai '$nama' berhasil dihapus!");
}

}
