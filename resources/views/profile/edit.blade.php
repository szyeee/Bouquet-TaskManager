@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-black leading-tight">
        {{ __('Edit Profile') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Status Message --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- Edit Profile --}}
        <form method="POST" action="{{ route('profile.update') }}" class="mb-8">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-black-700">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" />
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" />
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-100 shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('profile.show') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">
                    Batal
                </a>
            </div>
        </form>

        {{-- Ubah Password --}}
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')

            <h3 class="font-semibold text-lg mb-4">Ubah Password</h3>

            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700">Password Sekarang</label>
                <input id="current_password" name="current_password" type="password" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" />
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input id="password" name="password" type="password" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" />
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" />
                @error('password_confirmation')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-indigo-600 text-indigo-600 rounded-md hover:bg-yellow-100 shadow-sm">
                    Ganti Password
                </button>
                <a href="{{ route('profile.show') }}" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">
                    Batal
                </a>
            </div>
        </form>

        {{-- Hapus Akun --}}
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-15">
            @csrf
            @method('DELETE')

            <button type="submit" onclick="return confirm('Yakin ingin menghapus akun ini?')"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Hapus Akun
            </button>
        </form>
    </div>
</div>
@endsection
