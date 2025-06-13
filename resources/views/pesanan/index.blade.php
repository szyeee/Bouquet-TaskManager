@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if(session('success'))
        <div class="mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4 text-3xl font-bold text-pink-600">Daftar Pesanan</h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <a href="{{ route('pesanan.create') }}"
           class="inline-block text-white bg-pink-500 hover:bg-pink-600 px-5 py-2.5 rounded-lg font-semibold shadow">
            + Tambah Pesanan
        </a>

        {{-- Form Search & Filter --}}
        <form action="{{ route('pesanan.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-3">
            <input
                type="text"
                name="search"
                placeholder="Cari Nama Pembeli..."
                value="{{ request('search') }}"
                class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
            />
            <select name="filter" class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400">
                <option value="">Filter ID Pesanan</option>
                <option value="baru" {{ request('filter') == 'baru' ? 'selected' : '' }}>Terbaru (desc)</option>
                <option value="lama" {{ request('filter') == 'lama' ? 'selected' : '' }}>Terlama (asc)</option>
            </select>
            <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white rounded-lg px-5 py-2 font-semibold shadow transition duration-300">
                Cari
            </button>
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-x-auto border border-pink-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-100">
                <tr>
                    @foreach (['ID Pesanan', 'Nama Pembeli', 'Produk', 'Status', 'Jumlah', 'Harga', 'Jumlah Harga', 'Aksi'] as $i => $header)
                        <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide text-center 
                            {{ in_array($i, [5,6]) ? 'whitespace-nowrap w-32' : '' }}">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @forelse ($pesanan as $p)
                <tr class="hover:bg-pink-100/50 transition">
                    <td class="px-4 py-4 text-pink-800 font-medium text-center">{{ $p->kode_pesanan }}</td>
                    <td class="px-4 py-4 text-pink-800 font-medium">{{ $p->nama_pembeli }}</td>
                    <td class="px-4 py-4 text-pink-700">{{ $p->produk->nama ?? '-' }}</td>
                    <td class="px-4 py-4 text-pink-700">{{ ucfirst($p->status) }}</td>
                    <td class="px-4 py-4 text-pink-700 text-center">{{ $p->jumlah }}</td>
                    <td class="px-4 py-4 text-pink-700 whitespace-nowrap w-32 text-sm">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-4 text-pink-700 whitespace-nowrap w-32 text-sm">
                        Rp {{ number_format($p->jumlah_harga, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-4 text-right whitespace-nowrap">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('pesanan.edit', $p->id) }}"
                               class="text-white bg-yellow-400 hover:bg-yellow-500 px-4 py-1.5 rounded-lg text-sm font-semibold shadow-sm">
                                Edit
                            </a>

                            <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
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
                    <td colspan="8" class="px-6 py-4 text-center text-pink-400 italic">
                        Data pesanan kosong.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
