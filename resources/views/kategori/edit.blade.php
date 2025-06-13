@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">Edit Kategori</h1>

  @if(session('success'))
    <div class="alert alert-success mb-4 text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-600 rounded p-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- Peringatan di atas --}}
  <div class="mb-4 text-yellow-800 bg-yellow-100 dark:bg-yellow-900 dark:text-yellow-300 border border-yellow-300 dark:border-yellow-700 rounded p-3">
    Yakin ingin mengubah kategori ini?
  </div>

  <div class="bg-pink-50 dark:bg-gray-800 shadow rounded-lg p-6 space-y-6">
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
      @csrf
      @method('PATCH')

      {{-- Nama Kategori --}}
      <div>
        <label for="nama_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Kategori</label>
        <input 
          type="text" 
          id="nama_kategori" 
          name="nama_kategori" 
          value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('nama_kategori')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Jenis Bunga --}}
      <div>
        <label for="jenis_bunga" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Jenis Bunga</label>
        <input 
          type="text" 
          id="jenis_bunga" 
          name="jenis_bunga" 
          value="{{ old('jenis_bunga', $kategori->jenis_bunga) }}" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('jenis_bunga')
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
          value="{{ old('harga', $kategori->harga) }}" 
          min="0" 
          step="0.01"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('harga')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tombol --}}
      <div class="flex space-x-3">
        <button 
          type="submit" 
          class="inline-flex justify-center py-2 px-4 bg-pink-600 text-white rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Simpan
        </button>
        <a href="{{ route('kategori.index') }}" 
           class="inline-flex justify-center py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
