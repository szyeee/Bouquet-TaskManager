<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    // Status pengiriman
    const STATUS_DIKIRIM = 'dikirim';
    const STATUS_TERKIRIM = 'terkirim';

    public function index(Request $request)
    {
        $query = Pengiriman::with('pesanan');

        // Search berdasarkan kode pesanan
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pesanan', function ($q) use ($search) {
                $q->where('kode_pesanan', 'like', "%{$search}%");
            });
        }

        // Filter status pengiriman
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting tanggal kirim
        if ($request->filled('tanggal')) {
            $query->orderBy('tanggal_kirim', $request->tanggal === 'terlama' ? 'asc' : 'desc');
        } else {
            $query->orderBy('tanggal_kirim', 'desc');
        }

        $pengiriman = $query->paginate(10)->withQueryString();

        return view('pengiriman.index', compact('pengiriman'));
    }

    public function create()
    {
        $pesanan = Pesanan::all();
        return view('pengiriman.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePengiriman($request);

        Pengiriman::create($validated);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        $pesanan = Pesanan::all();

        return view('pengiriman.edit', compact('pengiriman', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validatePengiriman($request);

        $pengiriman = Pengiriman::findOrFail($id);
        $pengiriman->update($validated);

        return redirect()->route('pengiriman.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function destroy(Pengiriman $pengiriman)
    {
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil dihapus.');
    }

    /**
     * Validasi pengiriman secara terpusat
     */
    private function validatePengiriman(Request $request)
    {
        $rules = [
            'pesanan_id' => 'required|exists:pesanan,id',
            'alamat' => 'required|string|max:500',
            'status' => 'required|string|max:50',
        ];

        if (in_array($request->status, [self::STATUS_DIKIRIM, self::STATUS_TERKIRIM])) {
            $rules['tanggal_kirim'] = 'required|date';
        } else {
            $rules['tanggal_kirim'] = 'nullable|date';
        }

        return $request->validate($rules);
    }
}
