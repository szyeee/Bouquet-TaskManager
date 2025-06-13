<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis_bunga' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Kategori::create([
            'nama' => $request->nama_kategori,
            'jenis_bunga' => $request->jenis_bunga,
            'harga' => $request->harga,
        ]);


        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis_bunga'   => 'required|string|max:255',
            'harga'         => 'required|numeric|min:0',
        ]);

        // Map nama_kategori ➔ nama
        $kategori->update([
            'nama'        => $data['nama_kategori'],
            'jenis_bunga' => $data['jenis_bunga'],
            'harga'       => $data['harga'],
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
