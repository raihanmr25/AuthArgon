@extends('app')
@section('title', 'Register')

@section('content')
<section class="bg-gradient-to-b from-blue-700 via-blue-700 to-gray-800 text-white min-h-screen flex items-center justify-center">
  <div class="p-8 sm:p-10 w-full bg-gray-900/60 max-w-md border border-gray-300 rounded-xl">
    <form action="{{ route('register') }}" method="POST" class="space-y-5" onsubmit="return validateBeforeSubmit()">
      @csrf

      {{-- Title --}}
      <div class="text-center mb-6">
        <img src="{{ asset('assets/tie images.png') }}" alt="Logo" class="w-20 h-20 mx-auto mb-4 rounded-full bg-white/80 border border-gray-300 shadow">
        <h2 class="text-2xl font-extrabold text-white">Create Account 🚀</h2>
        <p class="text-sm text-white/80 mt-2">Join us and start your journey today</p>
      </div>

      {{-- Name --}}
      <div>
        <label for="name" class="block text-white font-medium">Full Name</label>
        <input type="text" name="name" id="name" placeholder="Your full name"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 mt-1 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
          required value="{{ old('name') }}">
        @error('name') <p class="text-red-300 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-white font-medium">Email Address</label>
        <input type="email" name="email" id="email" placeholder="you@example.com"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 mt-1 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
          required value="{{ old('email') }}">
        @error('email') <p class="text-red-300 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-white font-medium">Password</label>
        <input type="password" name="password" id="password" placeholder="Min. 8 characters, kapital awal, spesial"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 mt-1 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
          required>
      </div>

      {{-- Confirm Password --}}
      <div>
        <label for="password_confirmation" class="block text-white font-medium">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
          class="w-full px-4 py-3 rounded-lg bg-white/20 text-white placeholder-white/70 mt-1 backdrop-blur-sm border border-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white/30 transition"
          required>
      </div>

      {{-- Error Modal --}}
      <div id="password-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 text-gray-800">
          <h3 class="text-lg font-semibold mb-2">⚠️ Password tidak valid</h3>
          <p id="password-warning" class="text-sm mb-4"></p>
          <div class="text-right">
            <button type="button" onclick="closePasswordModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
              Tutup
            </button>
          </div>
        </div>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition-transform hover:scale-105 duration-300">
        Register
      </button>
    </form>

    {{-- OR separator --}}
    <div class="mt-6 flex items-center justify-between text-sm text-white/60">
      <hr class="w-1/3 border-white/40">
      <span class="block text-white font-medium">OR</span>
      <hr class="w-1/3 border-white/40">
    </div>

    {{-- Login redirect --}}
    <div class="mt-5 text-center">
      <p class="block text-white font-medium">Already have an account?
        <a href="{{ route('login') }}" class="text-blue-400 font-semibold hover:underline">Log In</a>
      </p>
    </div>
  </div>
</section>

{{-- Validation Script --}}
<script>
  function showPasswordModal(message) {
    document.getElementById('password-warning').textContent = message;
    document.getElementById('password-modal').classList.remove('hidden');
  }

  function closePasswordModal() {
    document.getElementById('password-modal').classList.add('hidden');
  }

  function validateBeforeSubmit() {
    const password = document.getElementById('password').value;
    const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

    let errorMsg = '';

    if (password.length < 8) {
      errorMsg = 'Password harus minimal 8 karakter.';
    } else if (!/^[A-Z]/.test(password)) {
      errorMsg = 'Password harus dimulai dengan huruf kapital.';
    } else if (!specialCharRegex.test(password)) {
      errorMsg = 'Password harus mengandung minimal satu karakter spesial.';
    }

    if (errorMsg !== '') {
      showPasswordModal(errorMsg);
      return false;
    }

    return true;
  }
</script>
@endsection
