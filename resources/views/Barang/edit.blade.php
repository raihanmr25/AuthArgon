@extends('app')
@section('title', 'Barang | Edit')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Data Barang</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="nibar" class="block font-medium text-sm text-gray-700">NIBAR</label>
                <input type="text" name="nibar" id="nibar" value="{{ old('nibar', $barang->nibar) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="kode_barang" class="block font-medium text-sm text-gray-700">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang', $barang->kode_barang) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="nama_barang" class="block font-medium text-sm text-gray-700">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="spesifikasi_nama_barang" class="block font-medium text-sm text-gray-700">Spesifikasi</label>
                <input type="text" name="spesifikasi_nama_barang" id="spesifikasi_nama_barang" value="{{ old('spesifikasi_nama_barang', $barang->spesifikasi_nama_barang) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="lokasi" class="block font-medium text-sm text-gray-700">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $barang->lokasi) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="pemakai" class="block font-medium text-sm text-gray-700">Nama Pemakai</label>
                <input type="text" name="pemakai" id="pemakai" value="{{ old('pemakai', $barang->nama_pemakai) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="status" class="block font-medium text-sm text-gray-700">Status Pemakai</label>
                <input type="text" name="status" id="status" value="{{ old('status', $barang->status_pemakai) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="jabatan" class="block font-medium text-sm text-gray-700">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $barang->jabatan) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="identitas" class="block font-medium text-sm text-gray-700">Nomor Identitas</label>
                <input type="text" name="identitas" id="identitas" value="{{ old('identitas', $barang->nomor_identitas_pemakai) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat Pemakai</label>
                <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $barang->alamat_pemakai) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="no_bast" class="block font-medium text-sm text-gray-700">BAST Nomor</label>
                <input type="text" name="no_bast" id="no_bast" value="{{ old('no_bast', $barang->bast_nomor) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="tgl_bast" class="block font-medium text-sm text-gray-700">BAST Tanggal</label>
                <input type="date" name="tgl_bast" id="tgl_bast" value="{{ old('tgl_bast', $barang->bast_tanggal) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="dokumen" class="block font-medium text-sm text-gray-700">Dokumen Nama</label>
                <input type="text" name="dokumen" id="dokumen" value="{{ old('dokumen', $barang->dokumen_nama) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="no_dok" class="block font-medium text-sm text-gray-700">Dokumen Nomor</label>
                <input type="text" name="no_dok" id="no_dok" value="{{ old('no_dok', $barang->dokumen_nomor) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="tgl_dok" class="block font-medium text-sm text-gray-700">Dokumen Tanggal</label>
                <input type="date" name="tgl_dok" id="tgl_dok" value="{{ old('tgl_dok', $barang->dokumen_tanggal) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="col-span-2">
                <label for="keterangan" class="block font-medium text-sm text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="w-full border rounded px-3 py-2 mt-1">{{ old('keterangan', $barang->keterangan) }}</textarea>
            </div>

            <div>
                <label for="no_simda" class="block font-medium text-sm text-gray-700">No SIMDA</label>
                <input type="text" name="no_simda" id="no_simda" value="{{ old('no_simda', $barang->no_simda) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="new" class="block font-medium text-sm text-gray-700">New</label>
                <input type="text" name="new" id="new" value="{{ old('new', $barang->new) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label for="tahun" class="block font-medium text-sm text-gray-700">Tahun</label>
                <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $barang->tahun) }}" class="w-full border rounded px-3 py-2 mt-1">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Update Barang
            </button>
        </div>
    
    </form>
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                <a href="{{ route('item') }}" class="text-white">Kembali</a>
            </button>
        </div>
</div>
@endsection
