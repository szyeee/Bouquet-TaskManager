@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">Tambah Pesanan</h1>

  @if(session('success'))
    <div class="alert alert-success mb-4 text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-600 rounded p-3">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-pink-50 dark:bg-gray-800 shadow rounded-lg p-6 space-y-6">
    <form action="{{ route('pesanan.store') }}" method="POST">
      @csrf

      {{-- Nama Pembeli --}}
      <div>
        <label for="nama_pembeli" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pembeli</label>
        <input
          type="text"
          id="nama_pembeli"
          name="nama_pembeli"
          value="{{ old('nama_pembeli') }}"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('nama_pembeli')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Produk --}}
      <div>
        <label for="produk_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Produk</label>
        <select
          id="produk_id"
          name="produk_id"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
          <option value="">-- Pilih Produk --</option>
          @foreach($produk as $p)
            <option value="{{ $p->id }}" {{ old('produk_id') == $p->id ? 'selected' : '' }}>
              {{ $p->nama }}
            </option>
          @endforeach
        </select>
        @error('produk_id')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Status --}}
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
        <input
          type="text"
          id="status"
          name="status"
          value="{{ old('status') }}"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('status')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Jumlah --}}
      <div>
        <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah</label>
        <input
          type="number"
          id="jumlah"
          name="jumlah"
          min="1"
          value="{{ old('jumlah', 1) }}"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('jumlah')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Harga --}}
      <div>
        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
        <input
          type="number"
          id="harga"
          name="harga"
          min="0"
          value="{{ old('harga', 0) }}"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('harga')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Jumlah Harga (otomatis) --}}
      <div>
        <label for="jumlah_harga" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jumlah Harga</label>
        <input
          type="number"
          id="jumlah_harga"
          name="jumlah_harga"
          readonly
          class="mt-1 block w-full bg-gray-100 dark:bg-gray-600 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm cursor-not-allowed" />
      </div>

      {{-- Tombol --}}
      <div class="flex space-x-3">
        <button
          type="submit"
          class="inline-flex justify-center py-2 px-4 bg-pink-600 text-white rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Simpan
        </button>
        <a href="{{ route('pesanan.index') }}"
          class="inline-flex justify-center py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600">
          Batal
        </a>
      </div>
    </form>
  </div>
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
