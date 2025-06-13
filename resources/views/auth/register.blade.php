@extends('layouts.guest')

@section('title', 'Register')
@section('subtitle', 'Join the Barbie Brats!')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-5">
  @csrf

  {{-- Name --}}
  <div>
    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink" />
    @error('name')
      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  {{-- Email --}}
  <div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink" />
    @error('email')
      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  {{-- Password --}}
  <div>
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
    <input id="password" type="password" name="password" required
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink" />
    @error('password')
      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  {{-- Confirm Password --}}
  <div>
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink" />
  </div>

  {{-- Submit --}}
  <div>
    <button type="submit" class="w-full py-2 bg-barbiePink-dark hover:bg-barbiePink-dark/80 text-white font-medium rounded-2xl transition">
      Register
    </button>
  </div>

  <p class="mt-4 text-center text-sm text-gray-600">
    Already have an account?
    <a href="{{ route('login') }}" class="text-barbiePink hover:underline">Log in</a>
  </p>
</form>
@endsection
