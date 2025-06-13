@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-pink-700 dark:text-rose-200 leading-tight">
    {{ __('Profile') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Form Update Profile -->
        <div class="p-4 sm:p-8 bg-pink-50 dark:bg-rose-900 shadow sm:rounded-2xl">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <!-- Tombol Edit Profile -->
        <div class="p-4 sm:p-8 bg-pink-50 dark:bg-rose-900 shadow sm:rounded-2xl">
            <div class="max-w-xl">
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg shadow hover:bg-pink-700 dark:hover:bg-rose-600">
                    ✏️ Edit Profile
                </a>
            </div>
        </div>

        <!-- Form Update Password -->
        <div class="p-4 sm:p-8 bg-pink-50 dark:bg-rose-900 shadow sm:rounded-2xl">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <!-- Form Hapus Akun -->
        <div class="p-4 sm:p-8 bg-pink-50 dark:bg-rose-900 shadow sm:rounded-2xl">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</div>
@endsection
