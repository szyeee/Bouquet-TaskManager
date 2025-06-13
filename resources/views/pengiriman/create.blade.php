@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">Tambah Pengiriman</h1>

  @if(session('success'))
    <div class="alert alert-success mb-4 text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-600 rounded p-3">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-pink-50 dark:bg-gray-800 shadow rounded-lg p-6 space-y-6">
    <form action="{{ route('pengiriman.store') }}" method="POST">
      @csrf

      {{-- Pilih Pesanan --}}
      <div>
        <label for="pesanan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Pilih Pesanan</label>
        <select name="pesanan_id" id="pesanan_id" required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
          <option value="">-- Pilih Pesanan --</option>
          @foreach($pesanan as $psn)
            <option value="{{ $psn->id }}" data-nama="{{ $psn->nama_pembeli }}"
              {{ old('pesanan_id') == $psn->id ? 'selected' : '' }}>
              {{ $psn->kode_pesanan }} - {{ $psn->nama_pembeli }}
            </option>
          @endforeach
        </select>
        @error('pesanan_id')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Nama Pembeli (readonly) --}}
      <div>
        <label for="nama_pembeli" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Pembeli</label>
        <input type="text" id="nama_pembeli" readonly
          value="{{ old('nama_pembeli') }}"
          class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white border border-gray-300 dark:border-pink-600 rounded-md shadow-sm cursor-not-allowed" />
      </div>

      {{-- Alamat --}}
      <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Alamat Pengiriman</label>
        <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('alamat')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tanggal Kirim --}}
      <div>
        <label for="tanggal_kirim" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal Kirim</label>
        <input type="date" name="tanggal_kirim" id="tanggal_kirim" value="{{ old('tanggal_kirim') }}" required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('tanggal_kirim')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Status Pengiriman --}}
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status Pengiriman</label>
        <select name="status" id="status" required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
          <option value="">-- Pilih Status --</option>
          <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
          <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        @error('status')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex space-x-3 mt-6">
        <button type="submit"
          class="inline-flex justify-center py-2 px-4 bg-pink-600 text-white rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Simpan
        </button>
        <a href="{{ route('pengiriman.index') }}"
          class="inline-flex justify-center py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectPesanan = document.getElementById('pesanan_id');
    const namaInput = document.getElementById('nama_pembeli');

    function tampilNamaPembeli() {
      const selected = selectPesanan.options[selectPesanan.selectedIndex];
      namaInput.value = selected.getAttribute('data-nama') || '';
    }

    selectPesanan.addEventListener('change', tampilNamaPembeli);
    tampilNamaPembeli();
  });
</script>
@endsection
