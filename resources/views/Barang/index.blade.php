@extends('app')
@section('title', 'Barang')

@section('content')

<body class="font-sans bg-blue-50 text-gray-800">

  <div class="min-h-screen flex">

   <!-- Sidebar -->
<div class="w-64 bg-blue-500 text-white">
  <a href="dashboard">
    <div class="flex items-center h-16 px-4 bg-blue-600 text-xl font-bold space-x-2">
      <!-- Logo GTR SVG -->
      <img src="{{ asset('assets/Lambang_Kota_Semarang.png') }}" class="h-8 w-auto" alt="Logo GTR">
      <span class="tracking-wide">CarZ App</span>
    </div>
  </a>
  <nav class="px-6 py-4 space-y-3 font-medium">
    <a href="dashboard" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-blue-700 transition">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"  width="18" height="20"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round"  width="16" height="16" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> <path d="M15 18H9" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
    Dashboard
    </a>
    <a href="{{ route('item') }}" class="flex items-center gap-2 py-2 px-4 rounded-md hover:bg-blue-700 transition">
    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" width="16" height="16"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#ffffff;} </style> <g> <rect y="16" class="st0" width="86.398" height="80"></rect> <rect x="166.398" y="16" class="st0" width="345.602" height="80"></rect> <rect y="216" class="st0" width="86.398" height="80"></rect> <rect x="166.398" y="216" class="st0" width="345.602" height="80"></rect> <rect y="416" class="st0" width="86.398" height="80"></rect> <rect x="166.398" y="416" class="st0" width="345.602" height="80"></rect> </g> </g></svg>  
    Barang
    </a>
  </nav>
</div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">

      <!-- Header -->
       <header class="bg-white shadow-md px-12 h-16 flex items-center justify-between">
        <div class="flex items-center text-xl font-semibold text-blue-700 gap-2">
       <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24">
       <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
       </svg>
       Data Barang
        </div>
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
      </header>

      <!-- Table Content -->
      <main class="flex-1 px-6 py-8 max-w-7xl mx-auto">

        <div class="mb-6 flex justify-between items-center">
          <h2 class="text-2xl font-semibold text-blue-800">📋 Daftar Barang</h2>
          <a href="{{ route('barang.create') }}"
             class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
            + Tambah Barang
          </a>
        </div>
        <div class="mb-6 flex justify-between items-center">
          <a href="{{ route('data.cetak') }}"
             class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
              Unduh Data
          </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-auto p-4">
          <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-blue-100 text-blue-700 uppercase text-xs font-bold">
              <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-28 py-2 border">Barcode</th>
                <th class="px-4 py-2 border">NIBAR</th>
                <th class="px-4 py-2 border">Kode</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Spesifikasi</th>
                <th class="px-4 py-2 border">Lokasi</th>
                <th class="px-4 py-2 border">Pemakai</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Jabatan</th>
                <th class="px-4 py-2 border">Identitas</th>
                <th class="px-4 py-2 border">Alamat</th>
                <th class="px-4 py-2 border">No. BAST</th>
                <th class="px-4 py-2 border">Tgl. BAST</th>
                <th class="px-4 py-2 border">Dokumen</th>
                <th class="px-4 py-2 border">No. Dok</th>
                <th class="px-4 py-2 border">Tgl. Dok</th>
                <th class="px-4 py-2 border">Keterangan</th>
                <th class="px-4 py-2 border">No Simda</th>
                <th class="px-4 py-2 border">New</th>
                <th class="px-4 py-2 border">No Mesin</th>
                <th class="px-4 py-2 border">Tahun</th>
                <th class="px-4 py-2 border">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              @foreach ($items as $index => $item)
              <tr class="hover:bg-blue-50 transition">
                <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                <!-- QR Code Column -->
                <td class="px-4 py-2 border text-center">
                    @if ($item->barcode)
                        <div class="qr-code-container">
                          {{-- <img src="{{ asset('storage/' . $item->qr_path) }}" alt="QR Code" class="w-16 h-16 mx-auto qr-code" onclick="zoomQRCode(this)"> --}}
                          <img src="{{ asset('storage/app/public/barcode/' . $item->barcode . '.png') }}" alt="barcode" class="w-64 h-16 mx-auto" onclick="zoomQRCode(this)">
                        </div>
                    @else
                        <span class="text-gray-400 italic">No QR</span>
                    @endif
                </td>
                <td class="px-4 py-2 border">{{ $item->nibar }}</td>
                <td class="px-4 py-2 border">{{ $item->kode_barang }}</td>
                <td class="px-4 py-2 border">{{ $item->nama_barang }}</td>
                <td class="px-4 py-2 border">{{ $item->spesifikasi_nama_barang }}</td>
                <td class="px-4 py-2 border">{{ $item->lokasi }}</td>
                <td class="px-4 py-2 border">{{ $item->nama_pemakai }}</td>
                <td class="px-4 py-2 border">{{ $item->status_pemakai }}</td>
                <td class="px-4 py-2 border">{{ $item->jabatan }}</td>
                <td class="px-4 py-2 border">{{ $item->nomor_identitas_pemakai }}</td>
                <td class="px-4 py-2 border">{{ $item->alamat_pemakai }}</td>
                <td class="px-4 py-2 border">{{ $item->bast_nomor }}</td>
                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->bast_tanggal)->format('d-m-Y') }}</td>
                <td class="px-4 py-2 border">{{ $item->dokumen_nama }}</td>
                <td class="px-4 py-2 border">{{ $item->dokumen_nomor }}</td>
                <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->dokumen_tanggal)->format('d-m-Y') }}</td>
                <td class="px-4 py-2 border">{{ $item->keterangan }}</td>
                <td class="px-4 py-2 border">{{ $item->no_simda }}</td>
                <td class="px-4 py-2 border">{{ $item->new }}</td>
                <td class="px-4 py-2 border">{{ $item->no_mesin}}</td>
                <td class="px-4 py-2 border">{{ $item->tahun }}</td>
                <td class="px-4 py-2 border text-red-600">
                  <!-- Tombol Hapus -->
                  <button type="button"
                    class="inline-flex items-center bg-red-100 text-red-700 hover:bg-red-200 hover:text-red-900 font-semibold py-1 px-3 rounded-md text-sm transition-all shadow-sm"
                    onclick="showDeleteModal({{ $item->id }})">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                      Hapus
                    </button>
                <a href="{{ route('barang.edit', $item->id) }}"
                    class="flex items-center gap-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 hover:text-yellow-900 font-semibold py-1.5 px-3 rounded-md text-sm transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2m-1 0v14m-7-7h14" />
                    </svg>

                    <span>Edit</span>
                </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal Zoom QR Code -->
  <div id="qrZoomModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-4 rounded-lg">
      <img id="zoomedQRCode" src="" alt="Zoomed QR Code" class="max-w-full max-h-full">
      <button onclick="closeZoom()" class="absolute top-4 right-4 text-white bg-red-600 hover:bg-red-700 rounded-full p-2">X</button>
    </div>
  </div>

  <!-- Modal Delete Confirmation -->
  <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-96">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Konfirmasi Hapus</h3>
      <p>Apakah Anda yakin ingin menghapus item ini?</p>
      <form id="deleteForm" method="POST" action="" class="mt-4">
        @csrf
        @method('DELETE')
        <div class="flex justify-between mt-4">
          <button type="button" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md" onclick="closeDeleteModal()">Batal</button>
          <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Hapus</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    function zoomQRCode(image) {
      const zoomModal = document.getElementById('qrZoomModal');
      const zoomedQRCode = document.getElementById('zoomedQRCode');
      zoomedQRCode.src = image.src;
      zoomModal.classList.remove('hidden');
    }

    function closeZoom() {
      document.getElementById('qrZoomModal').classList.add('hidden');
    }

    function showDeleteModal(itemId) {
      const form = document.getElementById('deleteForm');
      form.action = `/barang/${itemId}`; // Make sure this route is correct
      document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
      document.getElementById('deleteModal').classList.add('hidden');
    }

    // Toggle User Dropdown (Logout)
    document.getElementById('userDropdownButton').addEventListener('click', function(event) {
      event.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      dropdown.classList.toggle('hidden');
    });

    // Hide dropdown when clicking outside of it
    window.addEventListener('click', function(event) {
      const dropdown = document.getElementById('userDropdown');
      if (!dropdown.contains(event.target) && !event.target.matches('#userDropdownButton')) {
        dropdown.classList.add('hidden');
      }
    });
  </script>

</body>

@endsection
