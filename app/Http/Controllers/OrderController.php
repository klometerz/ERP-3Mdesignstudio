<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $query = Order::with('pelanggan');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })
            ->orWhere('tanggal_order', 'like', "%{$search}%")
            ->orWhere('nilai_order', 'like', "%{$search}%")
            ->orWhere('status_order', 'like', "%{$search}%")
            ->orWhere('nama_pekerjaan', 'like', "%{$search}%");
    }

    $orders = $query->paginate(10)->withQueryString();

    return view('orders.index', [
        'orders' => $orders,
        'title' => 'Data Order'
    ]);
}



    public function create(Request $request)
    {
        $pelanggan = Pelanggan::all();
        $pelanggan_id = $request->pelanggan_id;
        return view('orders.create', [
            'pelanggan' => $pelanggan,
            'pelanggan_id' => $pelanggan_id,
            'title' => 'Tambah Order'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tanggal_order' => 'required|date',
            'tanggal_selesai_order' => 'required|date|after_or_equal:tanggal_order',
            'nilai_order' => 'required|integer',
            'status_order' => 'required|in:Proses,Selesai,Batal',
            'nama_pekerjaan' => 'nullable|string|max:255',
            'foto_before' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
           
        ]);

        $data = $request->only([
            'pelanggan_id',
            'tanggal_order',
            'tanggal_selesai_order',
            'nilai_order',
            'status_order',
            'nama_pekerjaan',
        ]);

        if ($request->hasFile('foto_before')) {
            $data['foto_before'] = $request->file('foto_before')->store('orders/foto_before', 'public');
        }

        if ($request->hasFile('foto_after')) {
            $data['foto_after'] = $request->file('foto_after')->store('orders/foto_after', 'public');
        }

        $data['updated_by'] = auth()->id(); // Catat siapa yang buat

        $order = Order::create($data);

        return redirect()->route('pelanggan.show', $order->pelanggan_id)
                         ->with('success', 'Order berhasil ditambahkan!');
    }

    public function show($id)
{
    $order = Order::with('pelanggan')->findOrFail($id);
    $user = auth()->user();

    // ✅ Admin bebas lihat semua
    if ($user->role->name === 'admin') {
        return view('orders.show', [
            'order' => $order,
            'title' => 'Detail Order'
        ]);
    }

    // ✅ Pelanggan hanya boleh lihat order miliknya sendiri
    if ($user->role->name === 'pelanggan') {
        if ($order->pelanggan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke order ini.');
        }

        return view('orders.show', [
            'order' => $order,
            'title' => 'Detail Order'
        ]);
    }

    abort(403);
}


    public function edit($id)
    {
        $user = auth()->user();

        if ($user->role->name !== 'admin') {
            abort(403, 'Anda tidak punya akses edit.');
        }
        $order = Order::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('orders.edit', [
            'order' => $order,
            'pelanggan' => $pelanggan,
            'title' => 'Edit Order'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'tanggal_order' => 'required|date',
            'tanggal_selesai_order' => 'required|date|after_or_equal:tanggal_order',
            'nilai_order' => 'required|integer',
            'status_order' => 'required|in:Proses,Selesai,Batal',
            'nama_pekerjaan' => 'nullable|string|max:255',
            'foto_before' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_after' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $order = Order::findOrFail($id);

        $data = $request->only([
            'pelanggan_id',
            'tanggal_order',
            'tanggal_selesai_order',
            'nilai_order',
            'status_order',
            'nama_pekerjaan',
        ]);

        if ($request->hasFile('foto_before')) {
            // Hapus foto_before lama kalau ada
            if ($order->foto_before && Storage::disk('public')->exists($order->foto_before)) {
                Storage::disk('public')->delete($order->foto_before);
            }

            $data['foto_before'] = $request->file('foto_before')->store('orders/foto_before', 'public');
        }

        if ($request->hasFile('foto_after')) {
            // Hapus foto_after lama kalau ada
            if ($order->foto_after && Storage::disk('public')->exists($order->foto_after)) {
                Storage::disk('public')->delete($order->foto_after);
            }

            $data['foto_after'] = $request->file('foto_after')->store('orders/foto_after', 'public');
        }

        $data['updated_by'] = auth()->id(); // Audit who update

        $order->update($data);

        return redirect()->route('pelanggan.show', $order->pelanggan_id)
                         ->with('success', 'Order berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if ($user->role->name !== 'admin') {
            abort(403, 'Anda tidak punya akses edit.');
        }
        $order = Order::findOrFail($id);
        $pelanggan_id = $order->pelanggan_id;
        $order->delete();

        return redirect()->route('pelanggan.show', $pelanggan_id)
                         ->with('success', 'Order berhasil dihapus!');
    }

    public function uploadFotoAfter(Request $request, $id)
{

    $user = auth()->user();

    // 🚫 Cegah semua role kecuali admin
    if ($user->role->name !== 'admin') {
        abort(403, 'Anda tidak memiliki akses untuk upload foto.');
    }

    $request->validate([
        'foto_after' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $order = Order::findOrFail($id);

    // Hapus foto after lama kalau ada
    if ($order->foto_after && Storage::disk('public')->exists($order->foto_after)) {
        Storage::disk('public')->delete($order->foto_after);
    }

    $order->foto_after = $request->file('foto_after')->store('orders/foto_after', 'public');
    $order->updated_by = auth()->id();
    $order->save();

    return redirect()->route('orders.show', $order->id)
                     ->with('success', 'Foto After berhasil diupload!');
}

}

