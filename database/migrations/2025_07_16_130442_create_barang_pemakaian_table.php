<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('barang_pemakaian', function (Blueprint $table) {
            $table->id(); // Ini bisa jadi pengganti kolom No.
            $table->string('nibar')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->text('spesifikasi_nama_barang')->nullable();
            $table->string('lokasi')->nullable();

            // Kolom Pemakai
            $table->string('nama_pemakai')->nullable();
            $table->string('status_pemakai')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nomor_identitas_pemakai')->nullable();
            $table->string('alamat_pemakai')->nullable();

            // Dokumen Sumber Penggunaan
            $table->string('bast_nomor')->nullable();
            $table->date('bast_tanggal')->nullable();

            // Dokumen Pendukung Lainnya
            $table->string('dokumen_nama')->nullable();
            $table->string('dokumen_nomor')->nullable();
            $table->date('dokumen_tanggal')->nullable();

            // Keterangan
            $table->text('keterangan')->nullable();
            $table->text('no_simda')->nullable();
            $table->text('new')->nullable();
            $table->text('tahun')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('qr_path')->nullable();

            // BARCODE
            $table->string('barcode',50)->unique()->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang_pemakaian');
    }
};
