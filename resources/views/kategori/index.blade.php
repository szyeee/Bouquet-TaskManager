@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if(session('success'))
        <div class="mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4 text-3xl font-bold text-pink-600">Daftar Kategori</h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <a href="{{ route('kategori.create') }}"
           class="inline-block text-white bg-pink-500 hover:bg-pink-600 px-5 py-2.5 rounded-lg font-semibold shadow">
            + Tambah Kategori
        </a>

        {{-- Jika ingin tambah fitur filter/search bisa ditambahkan di sini --}}
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-pink-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Nama Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Jenis Bunga</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Harga</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-pink-700 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @forelse($kategori as $k)
                <tr class="hover:bg-pink-100/50 transition">
                    <td class="px-6 py-4 text-pink-800 font-medium">{{ $k->nama }}</td>
                    <td class="px-6 py-4 text-pink-700">{{ $k->jenis_bunga }}</td>
                    <td class="px-6 py-4 text-pink-700">Rp{{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('kategori.edit', $k->id) }}"
                               class="text-white bg-yellow-400 hover:bg-yellow-500 px-4 py-1.5 rounded-lg text-sm font-semibold shadow-sm">
                                Edit
                            </a>

                            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-white bg-red-500 hover:bg-red-600 px-4 py-1.5 rounded-lg text-sm font-semibold shadow-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-pink-400 italic">Data kategori kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
