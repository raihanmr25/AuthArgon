@extends('app')
@section('title', 'Barang | Create')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-2 rounded">
      <div class="mt-6">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
              <a href="{{ route('item') }}" class="text-white">Kembali</a>
          </button>
      </div>
</div>
<div class="max-w-4xl mx-auto mt-2 bg-white shadow p-8 rounded">
  <h2 class="text-2xl font-bold mb-6">Input Barang Inventaris</h2>

  @if(session('success'))
    <div class="mb-4 text-green-600">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('barang.store') }}">
    @csrf

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-semibold">NIBAR</label>
        <input type="text" name="nibar" class="w-full border p-2 rounded" value="{{ old('nibar') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Kode Barang</label>
        <input type="text" name="kode_barang" class="w-full border p-2 rounded" value="{{ old('kode_barang') }}">
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full border p-2 rounded" required value="{{ old('nama_barang') }}">
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold">Spesifikasi</label>
        <textarea name="spesifikasi_nama_barang" class="w-full border p-2 rounded">{{ old('spesifikasi_nama_barang') }}</textarea>
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold">Lokasi</label>
        <input type="text" name="lokasi" class="w-full border p-2 rounded" value="{{ old('lokasi') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Nama Pemakai</label>
        <input type="text" name="nama_pemakai" class="w-full border p-2 rounded" value="{{ old('nama_pemakai') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Status Pemakai</label>
        <input type="text" name="status_pemakai" class="w-full border p-2 rounded" value="{{ old('status_pemakai') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Jabatan</label>
        <input type="text" name="jabatan" class="w-full border p-2 rounded" value="{{ old('jabatan') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Nomor Identitas</label>
        <input type="text" name="nomor_identitas_pemakai" class="w-full border p-2 rounded" value="{{ old('nomor_identitas_pemakai') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Nomor Mesin</label>
        <input type="text" name="no_mesin" class="w-full border p-2 rounded" value="{{ old('no_mesin') }}">
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold">Alamat Pemakai</label>
        <input type="text" name="alamat_pemakai" class="w-full border p-2 rounded" value="{{ old('alamat_pemakai') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">No. BAST</label>
        <input type="text" name="bast_nomor" class="w-full border p-2 rounded" value="{{ old('bast_nomor') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Tanggal BAST</label>
        <input type="date" name="bast_tanggal" class="w-full border p-2 rounded" value="{{ old('bast_tanggal') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Nama Dokumen</label>
        <input type="text" name="dokumen_nama" class="w-full border p-2 rounded" value="{{ old('dokumen_nama') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">No. Dokumen</label>
        <input type="text" name="dokumen_nomor" class="w-full border p-2 rounded" value="{{ old('dokumen_nomor') }}">
      </div>

      <div>
        <label class="block text-sm font-semibold">Tgl. Dokumen</label>
        <input type="date" name="dokumen_tanggal" class="w-full border p-2 rounded" value="{{ old('dokumen_tanggal') }}">
      </div>

      <div class="col-span-2">
        <label class="block text-sm font-semibold">Keterangan</label>
        <textarea name="keterangan" class="w-full border p-2 rounded">{{ old('keterangan') }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-semibold">No Simda</label>
        <input type="text" name="no_simda" class="w-full border p-2 rounded" value="{{ old('no_simda') }}">
      </div>
      <div>
        <label class="block text-sm font-semibold">New</label>
        <input type="text" name="new" class="w-full border p-2 rounded" value="{{ old('new') }}">
      </div>



    <div>
      <label class="block text-sm font-semibold">Tahun</label>
      <input type="text" name="tahun" class="w-full border p-2 rounded" value="{{ old('tahun') }}">
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </div>
  </form>
</div>
@endsection
