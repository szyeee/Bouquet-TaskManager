@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">Edit Produk</h1>

  @if(session('success'))
    <div class="alert alert-success mb-4 text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-900 border border-green-300 dark:border-green-600 rounded p-3">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-pink-50 dark:bg-gray-800 shadow rounded-lg p-6 space-y-6">
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Nama Produk --}}
      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Produk</label>
        <input 
          type="text" 
          id="nama" 
          name="nama" 
          value="{{ old('nama', $produk->nama) }}" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('nama')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kategori --}}
      <div>
        <label for="kategori_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Kategori</label>
        <select 
          id="kategori_id" 
          name="kategori_id" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-pink-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500">
          @foreach($kategori as $k)
            <option value="{{ $k->id }}" {{ (old('kategori_id', $produk->kategori_id) == $k->id) ? 'selected' : '' }}>
              {{ $k->nama }}
            </option>
          @endforeach
        </select>
        @error('kategori_id')
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
          value="{{ old('harga', $produk->harga) }}" 
          min="0" 
          step="0.01"
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('harga')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tipe Stok --}}
      <div>
        <label for="tipe_stok" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipe Stok</label>
        <input 
          type="text" 
          id="tipe_stok" 
          name="tipe_stok" 
          value="{{ old('tipe_stok', $produk->tipe_stok) }}" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('tipe_stok')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Stok --}}
      <div>
        <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Stok</label>
        <input 
          type="number" 
          id="stok" 
          name="stok" 
          value="{{ old('stok', $produk->stok) }}" 
          min="0" 
          required
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('stok')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Foto --}}
      <div>
        <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Foto Produk (Opsional)</label>
        <input 
          type="file" 
          id="foto" 
          name="foto" 
          accept="image/*"
          class="mt-1 block w-full bg-white dark:bg-gray-700 text-gray-900 dark:text-white border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-pink-500 focus:border-pink-500" />
        @error('foto')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        @if($produk->foto)
          <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" class="mt-3 h-24 object-cover rounded">
        @endif
      </div>

      {{-- Tombol --}}
      <div class="flex space-x-3">
        <button 
          type="submit" 
          class="inline-flex justify-center py-2 px-4 bg-pink-600 text-white rounded-md shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
          Update
        </button>
        <a href="{{ route('produk.index') }}" 
           class="inline-flex justify-center py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-md shadow-sm hover:bg-gray-300 dark:hover:bg-gray-600">
          Batal
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
