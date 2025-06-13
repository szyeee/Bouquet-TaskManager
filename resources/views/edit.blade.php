@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-pink-700 dark:text-rose-200 leading-tight">
    {{ __('Edit Profile') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-pink-600 dark:text-pink-300">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-pink-800 dark:text-rose-100">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                    class="border-pink-300 dark:border-rose-600 dark:bg-rose-950 dark:text-rose-100 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm w-full" />
                @error('name')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-pink-800 dark:text-rose-100">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    class="border-pink-300 dark:border-rose-600 dark:bg-rose-950 dark:text-rose-100 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm w-full" />
                @error('email')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-white hover:bg-pink-700 dark:hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>

        <!-- Tombol Hapus Akun -->
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')

            <button type="submit"
                onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini? Semua data akan hilang.')"
                class="inline-flex items-center px-4 py-2 bg-rose-600 border border-transparent rounded-md font-semibold text-white hover:bg-rose-700 dark:hover:bg-rose-500 focus:outline-none focus:ring-2 focus:ring-rose-400">
                🗑️ Hapus Akun
            </button>
        </form>
    </div>
</div>
@endsection
