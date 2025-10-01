@extends('app')
@section('title', 'Dashboard')

@section('content')
<body class="font-sans bg-blue-50 text-gray-800">

  <div class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-400 text-white">
      <a href="dashboard">
        <div class="flex items-center h-16 px-4 bg-blue-700 text-xl font-bold space-x-2 shadow-md">
          <img src="{{ asset('assets/Lambang_Kota_Semarang.png') }}" class="h-8 w-auto" alt="Logo GTR">
          <span class="tracking-wide">CarZ App</span>
        </div>
      </a>
      <nav class="px-6 py-4 space-y-3 font-medium">
        <a href="dashboard" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-blue-700 hover:shadow transition-all duration-300">
          <!-- Icon -->
          <svg viewBox="0 0 24 24" fill="none" width="18" height="20" stroke="#fff" stroke-width="1.5"><path d="M22 12.2V13.7C22 17.6 22 19.6 20.8 20.8C19.7 22 17.8 22 14 22H10C6.2 22 4.3 22 3.2 20.8C2 19.6 2 17.6 2 13.7V12.2C2 9.9 2 8.8 2.5 7.8C3 6.9 4 6.3 5.9 5.1L7.9 3.9C9.9 2.6 10.9 2 12 2C13.1 2 14.1 2.6 16.1 3.9L18.1 5.1C20 6.3 21 6.9 21.5 7.8"/></svg>
          Dashboard
        </a>
        <a href="{{ route('item') }}" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-blue-700 hover:shadow transition-all duration-300">
          <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" width="18" height="18"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          Barang
        </a>
      </nav>
    </div>
    

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

      <!-- Topbar -->
      <header class="bg-white shadow-md px-12 h-16 flex items-center justify-between rounded-b-xl">
        <div class="flex items-center text-xl font-semibold text-blue-700 gap-2">
          <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
          </svg>
          Dashboard Inventaris
        </div>

        <div class="relative flex items-center space-x-3">
          @auth
          <div class="relative">
            <button id="userDropdownButton" class="flex items-center gap-2 focus:outline-none">
              <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="h-8 w-8 rounded-full border border-gray-300">
              <span>{{ Auth::user()->name }}</span>
              <svg class="h-4 w-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z"/>
              </svg>
            </button>
            <div id="userDropdown" class="absolute right-0 mt-2 w-40 bg-white text-gray-700 shadow-lg rounded-md z-50 hidden">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center px-4 py-2 text-sm hover:bg-gray-100 w-full">
                  <svg class="h-4 w-4 mr-2 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                  </svg>
                  Logout
                </button>
              </form>
            </div>
          </div>
          @else
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Masuk</a>
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">Daftar</a>
            @endif
          @endauth
        </div>
      </header>

      <!-- Main Content -->
      <main class="flex-1">

        <!-- Banner Carousel -->
        <div class="px-6 pt-6">
          <div class="relative w-full h-56 overflow-hidden rounded-xl shadow-xl">
            <div id="bannerCarousel" class="flex transition-all duration-700 ease-in-out">
              <img src="{{ asset('assets/images1.jpeg') }}" class="w-full h-56 object-cover flex-shrink-0 rounded-xl" alt="Banner 1">
              <img src="{{ asset('assets/images2.jpeg') }}" class="w-full h-56 object-cover flex-shrink-0 rounded-xl" alt="Banner 2">
              <img src="{{ asset('assets/images3.jpeg') }}" class="w-full h-56 object-cover flex-shrink-0 rounded-xl" alt="Banner 3">
            </div>
            <button id="prevBtn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 text-gray-700 rounded-full p-2 shadow">&#10094;</button>
            <button id="nextBtn" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-70 hover:bg-opacity-100 text-gray-700 rounded-full p-2 shadow">&#10095;</button>
          </div>
        </div>

        
        <!-- Statistik Hari Ini -->
        <section class="px-6 pt-4">


          <!-- Barang Ditambahkan Hari Ini -->
          <div class="mt-6 bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
            <h2 class="text-lg font-semibold text-gray-700">Barang Ditambahkan Hari Ini</h2>
            @forelse ($todayItems as $item)
              <div class="mt-2">
                <!-- <p class="text-sm text-gray-700">{{ $item->nibar }}</p> -->
                <p class="text-sm text-gray-700">{{ $item->nama_barang }}</p>
                <p class="text-xs text-gray-400">ditambahkan: {{ $item->created_at->format('H:i') }}</p>
              </div>
            @empty
              <p class="text-sm text-gray-500 mt-2">Tidak ada barang ditambahkan hari ini.</p>
            @endforelse
          </div>
        </section>

        <!-- Cards Section -->
        <section class="px-6 py-8 bg-blue-50">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:scale-[1.03] transition-transform duration-300 border border-gray-100" data-aos="fade-up">
              <div class="flex items-center">
                <div class="p-4 bg-green-100 rounded-full shadow">
                  <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M9 16h6M12 12v8" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h2 class="text-gray-800 font-semibold text-md">Jumlah Barang</h2>
                  <p class="text-sm text-gray-500">{{ $jumlah }} Data</p>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:scale-[1.03] transition-transform duration-300 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
              <div class="flex items-center">
                <div class="p-4 bg-yellow-100 rounded-full shadow">
                  <svg class="h-6 w-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m0-4h.01M12 20h.01M4 4h16v16H4V4z" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h2 class="text-gray-800 font-semibold text-md">Pemberitahuan</h2>
                  <p class="text-sm text-gray-500">5 Notifikasi</p>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-md p-6 hover:scale-[1.03] transition-transform duration-300 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
              <div class="flex items-center">
                <div class="p-4 bg-blue-100 rounded-full shadow">
                  <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                  </svg>
                </div>
                <div class="ml-4">
                  <h2 class="text-gray-800 font-semibold text-md">Laporan</h2>
                  <p class="text-sm text-gray-500">Update hari ini</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Statistik Hari Ini -->
        <section class="px-6 pb-12">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
              <h2 class="text-lg font-semibold text-gray-700">Data Hari Ini</h2>
              <p class="text-3xl font-bold text-blue-600 mt-2">{{ $todayItems->count() }}</p>
              <p class="text-sm text-gray-500">Ditambahkan pada {{ \Carbon\Carbon::today()->format('d M Y') }}</p>
            </div>
          </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white text-center text-sm text-gray-500 py-4 shadow-inner">
          &copy; {{ now()->year }} CarZ App. All rights reserved.
        </footer>
      </main>
    </div>
  </div>

  <!-- JS -->
  <script>
    const dropdownButton = document.getElementById('userDropdownButton');
    const dropdownMenu = document.getElementById('userDropdown');
    const carousel = document.getElementById("bannerCarousel");
    const totalSlides = carousel.children.length;
    let index = 0;

    function updateCarousel() {
      carousel.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
      index = (index + 1) % totalSlides;
      updateCarousel();
    }

    function prevSlide() {
      index = (index - 1 + totalSlides) % totalSlides;
      updateCarousel();
    }

    document.getElementById("nextBtn").addEventListener("click", nextSlide);
    document.getElementById("prevBtn").addEventListener("click", prevSlide);

    let autoSlide = setInterval(nextSlide, 4000);
    carousel.parentElement.addEventListener("mouseenter", () => clearInterval(autoSlide));
    carousel.parentElement.addEventListener("mouseleave", () => autoSlide = setInterval(nextSlide, 4000));

    dropdownButton.addEventListener('click', () => {
      dropdownMenu.classList.toggle('hidden');
    });
    window.addEventListener('click', (e) => {
      if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  </script>

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>AOS.init();</script>

</body>
@endsection
