@extends('layouts.app')

@section('content')
<div class="container max-w-3xl mx-auto px-4 py-8">
  <h1 class="mb-8 text-3xl font-bold text-gray-900 dark:text-white">Edit Pesanan</h1>

  <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengubah pesanan ini?')" class="space-y-6 bg-pink-50 dark:bg-gray-800 shadow rounded-lg p-6">
    @csrf
    @method('PUT')

    {{-- Kode Pesanan --}}
    <div>
      <label for="kode_pesanan" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">ID Pesanan</label>
      <input 
        type="text" 
        id="kode_pesanan" 
        name="kode_pesanan" 
        value="{{ old('kode_pesanan', $pesanan->kode_pesanan) }}" 
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm placeholder-gray-400
               focus:ring-pink-500 focus:border-pink-500" />
      @error('kode_pesanan')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Nama Pembeli --}}
    <div>
      <label for="nama_pembeli" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Nama Pembeli</label>
      <input 
        type="text" 
        id="nama_pembeli" 
        name="nama_pembeli" 
        value="{{ old('nama_pembeli', $pesanan->nama_pembeli) }}" 
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm placeholder-gray-400
               focus:ring-pink-500 focus:border-pink-500" />
      @error('nama_pembeli')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Produk --}}
    <div>
      <label for="produk_id" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Produk</label>
      <select
        id="produk_id"
        name="produk_id"
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm
               focus:ring-pink-500 focus:border-pink-500">
        <option value="" disabled {{ old('produk_id', $pesanan->produk_id) ? '' : 'selected' }}>-- Pilih Produk --</option>
        @foreach($produk as $p)
          <option value="{{ $p->id }}" {{ old('produk_id', $pesanan->produk_id) == $p->id ? 'selected' : '' }}>
            {{ $p->nama }}
          </option>
        @endforeach
      </select>
      @error('produk_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Status --}}
    <div>
      <label for="status" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Status</label>
      <input
        type="text"
        id="status"
        name="status"
        value="{{ old('status', $pesanan->status) }}"
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm placeholder-gray-400
               focus:ring-pink-500 focus:border-pink-500" />
      @error('status')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Jumlah --}}
    <div>
      <label for="jumlah" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Jumlah</label>
      <input
        type="number"
        id="jumlah"
        name="jumlah"
        min="1"
        value="{{ old('jumlah', $pesanan->jumlah) }}"
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm placeholder-gray-400
               focus:ring-pink-500 focus:border-pink-500" />
      @error('jumlah')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Harga --}}
    <div>
      <label for="harga" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Harga</label>
      <input
        type="number"
        id="harga"
        name="harga"
        min="0"
        value="{{ old('harga', $pesanan->harga) }}"
        required
        class="w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 shadow-sm placeholder-gray-400
               focus:ring-pink-500 focus:border-pink-500" />
      @error('harga')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Jumlah Harga (otomatis) --}}
    <div>
      <label for="jumlah_harga" class="block mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200">Jumlah Harga</label>
      <input
        type="number"
        id="jumlah_harga"
        name="jumlah_harga"
        readonly
        class="w-full rounded-md border border-gray-300 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white px-3 py-2 shadow-sm cursor-not-allowed" />
    </div>

    <p class="mt-6 mb-4 text-red-600 font-semibold">Yakin ingin mengubah pesanan ini?</p>

    <div class="flex space-x-4">
      <button 
        type="submit" 
        class="inline-flex items-center justify-center rounded-md bg-pink-600 px-6 py-2 text-white shadow-sm
               hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
        Simpan
      </button>
      <a href="{{ route('pesanan.index') }}" 
         class="inline-flex items-center justify-center rounded-md bg-gray-200 px-6 py-2 text-gray-700 shadow-sm
                hover:bg-gray-300 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
        Batal
      </a>
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const jumlahInput = document.getElementById('jumlah');
    const hargaInput  = document.getElementById('harga');
    const totalInput  = document.getElementById('jumlah_harga');

    function hitungTotal() {
      const qty = parseFloat(jumlahInput.value) || 0;
      const hr  = parseFloat(hargaInput.value)  || 0;
      totalInput.value = Math.round(qty * hr);
    }

    hitungTotal();

    jumlahInput.addEventListener('input', hitungTotal);
    hargaInput.addEventListener('input',  hitungTotal);
  });
</script>
@endsection
