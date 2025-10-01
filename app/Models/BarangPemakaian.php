<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangPemakaian extends Model
{
    //
    use HasFactory;

    protected $table = 'barang_pemakaian';

    protected $fillable = [
        'nibar',
        'kode_barang',
        'nama_barang',
        'spesifikasi_nama_barang',
        'lokasi',
        'nama_pemakai',
        'status_pemakai',
        'jabatan',
        'nomor_identitas_pemakai',
        'alamat_pemakai',
        'bast_nomor',
        'bast_tanggal',
        'dokumen_nama',
        'dokumen_nomor',
        'dokumen_tanggal',
        'keterangan',
        'no_simda',
        'new',
        'tahun',
        'no_mesin',
        // 'qr_path',
        'barcode',
        
    ];

    protected $dates = [
        'bast_tanggal',
        'dokumen_tanggal',
    ];

}
