<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>Login Minimal</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css'])
</head>
<body class="bg-bubblegum flex items-center justify-center min-h-screen p-4">
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-md p-6">
    <h1 class="text-2xl font-barbie text-center text-barbiePink mb-6">Log In</h1>
    
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
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
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink text-black"
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
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-barbiePink focus:border-barbiePink text-black"
        />
        @error('password')
          <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
      </div>

      {{-- Remember Me --}}
      <div class="flex items-center">
        <input
          type="checkbox"
          name="remember"
          id="remember"
          class="h-4 w-4 text-barbiePink focus:ring-barbiePink border-gray-300 rounded"
        />
        <label for="remember" class="ml-2 text-sm text-gray-700">Remember me</label>
      </div>

      {{-- Tombol Log In --}}
      <div>
        <button
          type="submit"
          class="w-full py-2 bg-barbiePink hover:bg-barbiePink-dark text-black font-medium rounded-2xl transition"
        >
          Log In
        </button>
      </div>

      {{-- Link ke Register --}}
      <p class="mt-4 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-barbiePink hover:underline">Register</a>
      </p>
    </form>
  </div>
</body>
</html>
