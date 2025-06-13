@extends('layouts.guest')

@section('title', 'Log In')
@section('subtitle', 'Welcome back, Barbie Brat!')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-5">
  @csrf

  {{-- Email --}}
  <div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
    <input
      id="email"
      type="email"
      name="email"
      value="{{ old('email') }}"
      required
      autofocus
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink"
    />
    @error('email')
      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  {{-- Password --}}
  <div>
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
    <input
      id="password"
      type="password"
      name="password"
      required
      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink"
    />
    @error('password')
      <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
  </div>

  {{-- Remember & Forgot --}}
  <div class="flex items-center justify-between text-sm">
    <label class="inline-flex items-center">
      <input
        type="checkbox"
        name="remember"
        class="h-4 w-4 text-barbiePink focus:ring-barbiePink border-gray-300 rounded"
      />
      <span class="ml-2 text-gray-700">Remember me</span>
    </label>
    @if(Route::has('password.request'))
      <a href="{{ route('password.request') }}" class="text-barbiePink hover:underline">
        Forgot your password?
      </a>
    @endif
  </div>

  {{-- Submit --}}
  <div>
    <button
      type="submit"
      class="w-full py-2 bg-barbiePink hover:bg-barbiePink-dark text-white font-medium rounded-2xl transition"
    >
      Log in
    </button>
  </div>

  <p class="mt-4 text-center text-sm text-gray-600">
    Don't have an account?
    <a href="{{ route('register') }}" class="text-barbiePink hover:underline">Register</a>
  </p>
</form>
@endsection
