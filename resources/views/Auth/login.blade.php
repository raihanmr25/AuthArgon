@extends('app')
@section('title', 'Login')

@section('content')

<!-- <section class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('assets/images4.jpg') }}');"> -->
<section class="bg-gradient-to-b from-blue-700 via-blue-700 to-gray-800 text-white min-h-screen flex items-center justify-center">
  <div class="p-8 sm:p-10 w-full max-w-md bg-gray-900/60 border border-gray-300 rounded-xl">
    {{-- Logo --}}
    <div class="text-center mb-6">
      <img src="{{ asset('assets/tie images.png') }}" alt="User Icon" class="w-24 h-24 mx-auto mb-4 rounded-full shadow-md border border-gray-300 bg-white/80">
      <h2 class="block text-white font-medium">Login to Your Account</h2>
      <p class="text-sm text-white/80 mt-1">Welcome back, please sign in</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5" onsubmit="return handleLogin(event)">
      @csrf

      {{-- Email --}}
      <div>
        <label for="email" class="block text-white font-medium">Email Address</label>
        <div class="relative mt-1">
          <input type="email" name="email" id="email" placeholder="you@example.com"
            class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
            required value="{{ old('email') }}">
          <span class="absolute left-3 top-3.5 text-white/80">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m0 0l4-4m0 8l-4-4" />
            </svg>
          </span>
        </div>
        @error('email') <p class="text-red-300 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-white font-medium">Password</label>
        <div class="relative mt-1">
          <input type="password" name="password" id="password" placeholder="••••••••"
            class="w-full pl-10 pr-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
            required>
          <span class="absolute left-3 top-3.5 text-white/80">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 1.104-.896 2-2 2s-2-.896-2-2 2-4 2-4 2 2.896 2 4zm6 3v5H6v-5c0-1.104.896-2 2-2h8c1.104 0 2 .896 2 2z" />
            </svg>
          </span>
        </div>
        @error('password') <p class="text-red-300 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Forgot Password --}}
      <div class="text-right">
        <a href="#" class="text-sm text-white/70 hover:underline">Forgot Password?</a>
      </div>

      {{-- Submit --}}
      <button id="loginBtn" type="submit"
        class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition-transform hover:scale-105 duration-300 flex justify-center items-center gap-2">
        <svg id="spinner" class="w-5 h-5 animate-spin hidden" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path>
        </svg>
        <span id="loginText">Login</span>
      </button>
    </form>

    {{-- OR Separator --}}
    <div class="mt-6 flex items-center justify-between text-sm text-white/70">
      <hr class="w-1/3 border-gray-400">
      <span class="mx-2">OR</span>
      <hr class="w-1/3 border-gray-400">
    </div>

    {{-- Register --}}
    <div class="mt-5 text-center">
      <p class="text-sm text-white/80">Don't have an account?
        <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:underline">Register</a>
      </p>
    </div>

  </div>
</section>

{{-- Script --}}
<script>
  function handleLogin(event) {
    const btn = document.getElementById('loginBtn');
    const spinner = document.getElementById('spinner');
    const text = document.getElementById('loginText');

    spinner.classList.remove('hidden');
    text.textContent = 'Logging in...';
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');
    
    return true; // lanjut submit form
  }
</script>

@endsection
