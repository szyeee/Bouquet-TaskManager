<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font "Lobster Two" -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap"
    rel="stylesheet"
  />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-bubblegum text-barbieBlack-dark">
  {{-- Navbar --}}
  <nav class="bg-barbiePink p-4 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
      {{-- Logo + Nama Aplikasi --}}
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
        <img
          src="{{ asset('images/Barbie.png') }}"
          alt="Logo"
          class="h-8"
          onerror="this.style.display='none'"
        />
        <span class="text-2xl font-barbie text-white">
          {{ config('app.name', 'Bouquet') }}
        </span>
      </a>

      {{-- Menu Kanan: Nama User → Dropdown Profile/Edit/Logout --}}
      <div class="flex items-center space-x-4">
        @auth
          <div class="relative" x-data="{ open: false }">
            {{-- 1 tombol tunggal: Nama User --}}
            <button
              @click="open = !open"
              class="flex items-center space-x-2 text-black focus:outline-none"
            >
              {{-- Nama user --}}
              <span class="text-base font-medium">{{ Auth::user()->name }}</span>
              {{-- Ikon panah ke bawah --}}
              <svg
                class="h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"
                ></path>
              </svg>
            </button>

            {{-- Dropdown Menu (tampil ketika open=true) --}}
            <div
              x-cloak
              x-show="open"
              @click.away="open = false"
              x-transition
              class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 z-50 hidden"
              :class="{ 'block': open, 'hidden': !open }"
            >
              <a
                href="{{ route('profile.show') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
              >
                Profile
              </a>
              <a
                href="{{ route('profile.edit') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
              >
                Edit Profile
              </a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                  type="submit"
                  class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                >
                  Logout
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('login') }}" class="text-black hover:underline">Log In</a>
          <a href="{{ route('register') }}" class="text-black hover:underline">Register</a>
        @endauth
      </div>
    </div>
  </nav>

  {{-- Main Content --}}
  <main class="container mx-auto px-4 py-6">
    @yield('content')
  </main>
</body>
</html>
