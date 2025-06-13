<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'Lumière') }}</title>

  {{-- Google Font: Lobster Two for Barbie aesthetic --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-pink-50 dark:bg-rose-950 text-pink-900 dark:text-rose-100">

  {{-- Navbar --}}
  <nav class="bg-pink-300 dark:bg-rose-800 p-4 shadow-lg">
    <div class="container mx-auto flex items-center justify-between">
      {{-- Logo + Nama Aplikasi --}}
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
        <img src="{{ asset('images/Barbie.png') }}" alt="Logo" class="h-9" />
        <span class="text-2xl font-barbie text-white drop-shadow-md">
          {{ config('app.name', 'Bouquet') }}
        </span>
      </a>

      {{-- Menu Kanan: User Auth --}}
      <div class="flex items-center space-x-4">
        @auth
        <div class="relative" x-data="{ open: false }">
          {{-- Tombol Nama User --}}
          <button
            @click="open = !open"
            class="flex items-center space-x-2 text-white hover:text-pink-100 focus:outline-none transition duration-150 ease-in-out"
          >
            <span class="text-base font-semibold">{{ Auth::user()->name }}</span>
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>

          {{-- Dropdown --}}
          <div
            x-cloak
            x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute right-0 mt-2 w-44 bg-white dark:bg-rose-900 rounded-xl shadow-lg ring-1 ring-pink-300 dark:ring-rose-600 z-50"
          >
            <a href="{{ route('profile.show') }}"
              class="block px-4 py-2 text-pink-700 dark:text-rose-100 hover:bg-pink-100 dark:hover:bg-rose-700 rounded-t-xl">
              👤 Profile
            </a>
            <a href="{{ route('profile.edit') }}"
              class="block px-4 py-2 text-pink-700 dark:text-rose-100 hover:bg-pink-100 dark:hover:bg-rose-700">
              ✏️ Edit Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-left px-4 py-2 text-pink-700 dark:text-rose-100 hover:bg-pink-100 dark:hover:bg-rose-700 rounded-b-xl">
                🚪 Logout
              </button>
            </form>
          </div>
        </div>
        @else
        <a href="{{ route('login') }}"
          class="text-white hover:text-pink-100 font-medium transition duration-150 ease-in-out">Log In</a>
        <a href="{{ route('register') }}"
          class="text-white hover:text-pink-100 font-medium transition duration-150 ease-in-out">Register</a>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Main Content --}}
  <main class="container mx-auto px-4 py-8">
    @yield('content')
  </main>
</body>
</html>
