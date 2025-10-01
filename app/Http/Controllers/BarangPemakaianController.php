<?php

namespace App\Http\Controllers;
use App\Models\BarangPemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Str;


class BarangPemakaianController extends Controller
{
    //
     public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nibar' => 'nullable|string',
            'kode_barang' => 'nullable|string',
            'nama_barang' => 'required|string',
            'spesifikasi_nama_barang' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'nama_pemakai' => 'nullable|string',
            'status_pemakai' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'nomor_identitas_pemakai' => 'nullable|string',
            'alamat_pemakai' => 'nullable|string',
            'bast_nomor' => 'nullable|string',
            'bast_tanggal' => 'nullable|date',
            'dokumen_nama' => 'nullable|string',
            'dokumen_nomor' => 'nullable|string',
            'dokumen_tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'no_simda' => 'nullable|string',
            'new' => 'nullable|string',
            'no_mesin' => 'nullable|string',
            'tahun' => 'nullable|string',
            'barcode' => 'string'
        ]);

        if (empty($validated['barcode'])) {
            $validated['barcode'] = 'ASSET-' . strtoupper(Str::random(8));
        }

        $asset = BarangPemakaian::create($validated);

        // Save Bar CODE
        $fileName = 'barcode/' .$asset->barcode . 'png';
        $png = DNS1D::getBarCodePNG($asset->barcode, 'C128'); 
        Storage::disk('public')->put($fileName, base64_decode($png));


        return to_route('item')->with('success', 'Data barang berhasil disimpan dengan QR code!');
    }

    public function destroy($id)
{
    $barang = BarangPemakaian::findOrFail($id);
    $barang->delete();

    return redirect()->route('item')->with('success', 'Barang berhasil dihapus');
}

public function edit($id)
{
    return view('barang.edit', [
        'barang' => BarangPemakaian::findOrFail($id)
    ]);
}

public function update(Request $request, $id)
{
    $barang = BarangPemakaian::findOrFail($id);

    $barang->update([
        'nibar' => $request->nibar,
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'spesifikasi_nama_barang' => $request->spesifikasi_nama_barang,
        'lokasi' => $request->lokasi,
        'nama_pemakai' => $request->pemakai,
        'status_pemakai' => $request->status,
        'jabatan' => $request->jabatan,
        'nomor_identitas_pemakai' => $request->identitas,
        'alamat_pemakai' => $request->alamat,
        'bast_nomor' => $request->no_bast,
        'bast_tanggal' => $request->tgl_bast,
        'dokumen_nama' => $request->dokumen,
        'dokumen_nomor' => $request->no_dok,
        'dokumen_tanggal' => $request->tgl_dok,
        'keterangan' => $request->keterangan,
        'no_simda' => $request->no_simda,
        'new' => $request->new,
        'no_mesin' => $request->no_mesin,
        'tahun' => $request->tahun,
        
    ]);

    return redirect()->route('item')->with('success', 'Barang berhasil diedit');


}

}
