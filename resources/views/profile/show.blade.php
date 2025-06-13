@extends('layouts.app')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Profil Saya') }}
</h2>
@endsection

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-medium mb-4">Detail Profil</h3>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <a href="{{ route('profile.edit') }}" class="text-red font-medium hover:text-indigo-600 underline">
            Edit Profile
        </a>

    </div>
</div>
@endsection
