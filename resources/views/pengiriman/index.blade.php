@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    @if(session('success'))
        <div class="mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg px-4 py-3 shadow">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4 text-3xl font-bold text-pink-600">Daftar Pengiriman</h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <a href="{{ route('pengiriman.create') }}"
           class="inline-block text-white bg-pink-500 hover:bg-pink-600 px-5 py-2.5 rounded-lg font-semibold shadow">
            + Tambah Pengiriman
        </a>

        {{-- Form Search & Filter --}}
        <form action="{{ route('pengiriman.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-3">
            <input
                type="text"
                name="search_id"
                placeholder="Cari ID Pesanan..."
                value="{{ request('search_id') }}"
                class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400"
            />
            <select name="status"
                    class="border border-pink-300 rounded-lg px-3 py-2 text-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-400">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Terkirim</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
            <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white rounded-lg px-5 py-2 font-semibold shadow transition duration-300">
                Cari
            </button>
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-pink-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Kode Pesanan</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Nama Pembeli</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wide">Tanggal Kirim</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-pink-700 uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-100">
                @forelse($pengiriman as $p)
                <tr class="hover:bg-pink-100/50 transition">
                    <td class="px-6 py-4 text-pink-800 font-medium">{{ $p->pesanan->kode_pesanan }}</td>
                    <td class="px-6 py-4 text-pink-800">{{ $p->pesanan->nama_pembeli }}</td>
                    <td class="px-6 py-4 text-pink-700">{{ $p->alamat }}</td>
                    <td class="px-6 py-4 text-pink-700">{{ ucfirst($p->status) }}</td>
                    <td class="px-6 py-4 text-pink-700">{{ \Carbon\Carbon::parse($p->tanggal_kirim)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="inline-flex gap-2">
                            <a href="{{ route('pengiriman.edit', $p->id) }}"
                               class="text-white bg-yellow-400 hover:bg-yellow-500 px-4 py-1.5 rounded-lg text-sm font-semibold shadow-sm">
                                Edit
                            </a>
                            <form action="{{ route('pengiriman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengiriman ini?')" class="inline-block">
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
                    <td colspan="6" class="px-6 py-4 text-center text-pink-400 italic">Tidak ada data pengiriman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
