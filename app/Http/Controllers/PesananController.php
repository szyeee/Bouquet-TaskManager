<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PesananController extends Controller
{
   public function index(Request $request)
    {
        $query = Pesanan::query();

        // Search berdasarkan nama pembeli
        if ($request->filled('search')) {
            $query->where('nama_pembeli', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan ID pesanan (baru / lama)
        if ($request->filled('filter')) {
            if ($request->filter === 'baru') {
                $query->orderBy('id', 'desc');
            } elseif ($request->filter === 'lama') {
                $query->orderBy('id', 'asc');
            }
        } else {
            // Default sorting kalau mau, misal id desc
            $query->orderBy('id', 'desc');
        }

        $pesanan = $query->paginate(10)->withQueryString();

        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('pesanan.create', compact('produk'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'produk_id'    => 'required|exists:produk,id',
            'status'       => 'required|string',
            'jumlah'       => 'required|integer|min:1',
            'harga'        => 'required|numeric|min:0',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Cek stok sebelum membuat pesanan
        if ($produk->stok < $request->jumlah) {
            return back()
                ->withInput()
                ->withErrors(['jumlah' => 'Stok tidak cukup. Tersedia: ' . $produk->stok]);
        }

        // Siapkan data pesanan
        $data = [
            'nama_pembeli' => $request->nama_pembeli,
            'produk_id'    => $produk->id,
            'status'       => $request->status,
            'jumlah'       => $request->jumlah,
            'harga'        => $request->harga,
            'jumlah_harga' => $request->jumlah * $request->harga,
        ];

        // Create pesanan; stok akan disesuaikan oleh model event
        Pesanan::create($data);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function edit(Pesanan $pesanan)
    {
        $produk = Produk::all();
        return view('pesanan.edit', compact('pesanan', 'produk'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'produk_id'    => 'required|exists:produk,id',
            'status'       => 'required|string',
            'jumlah'       => 'required|integer|min:1',
            'harga'        => 'required|numeric|min:0',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Hitung stok tersedia (stok saat ini + jumlah lama pesanan)
        $availableStock = $produk->stok + $pesanan->jumlah;
        if ($availableStock < $request->jumlah) {
            return back()
                ->withInput()
                ->withErrors(['jumlah' => 'Stok tidak cukup. Tersedia: ' . $availableStock]);
        }

        // Update pesanan; stok disesuaikan oleh model event
        $pesanan->update([
            'nama_pembeli' => $request->nama_pembeli,
            'produk_id'    => $produk->id,
            'status'       => $request->status,
            'jumlah'       => $request->jumlah,
            'harga'        => $request->harga,
            'jumlah_harga' => $request->jumlah * $request->harga,
        ]);

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
}
