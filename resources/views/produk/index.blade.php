@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if(session('success'))
        <div class="mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4 text-3xl font-bold text-pink-600">Daftar Produk</h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <a href="{{ route('produk.create') }}"
           class="inline-block text-white bg-pink-500 hover:bg-pink-600 px-5 py-2.5 rounded-lg font-semibold shadow">
            + Tambah Produk
        </a>

        {{-- Form Search dan Filter --}}
        <form method="GET" action="{{ route('produk.index') }}" class="flex flex-col md:flex-row md:items-center gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama produk..."
                class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
            />
            <select
                name="kategori"
                class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
            >
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white rounded-lg px-5 py-2 font-semibold shadow transition duration-300">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-pink-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Stok</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-pink-700 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @forelse($produk as $item)
                    <tr class="hover:bg-pink-100/50 transition">
                        <td class="px-6 py-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama }}"
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm border border-pink-200" />
                            @else
                                <span class="text-pink-400 italic text-sm">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-pink-800 font-medium">{{ $item->nama }}</td>
                        <td class="px-6 py-4 text-pink-700">{{ $item->kategori->nama ?? '-' }}</td>
                        <td class="px-6 py-4 text-pink-700">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-pink-700">{{ $item->stok }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('produk.edit', $item->id) }}"
                                   class="text-white bg-yellow-400 hover:bg-yellow-500 px-4 py-1.5 rounded-lg text-sm font-semibold shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                        <td colspan="6" class="px-6 py-4 text-center text-pink-400 italic">
                            Tidak ada data produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
