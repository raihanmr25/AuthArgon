<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    public function index()
    {
        //layoutnya bisa temen-temen sesuaiin sama kebutuhannya temen-temen
        return view('admin.pages.qr_code.index');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|url',
        ]);
        
        // untuk usecase ku sendiri tidak menyimpan ke database
        // jadi aku akalin dengan nge-generate unique code yang
        // ku ambil dari waktu saat ini (saat mengenerate image QR)
        // lalu itu yang ku jadikan identifier untuk image yang di generate 
        $code = time();

        // untuk format, temen-temen bisa sesuaiin 
        // (format yang tersedia: png, eps, dan svg)
        // lalu temen-temen bisa menyesuaikan ukuran image QR-nya
        // dengan menambahkan ->size(ukuranDalamPixel, contoh: 100);
        // QrCode::format('png')->size(100)->generate($request->link);  
        $qr = QrCode::format('png')->generate($request->link);
        $qrImageName = $code . '.png';

        // simpan ke local storage
        Storage::put('public/qr/' . $qrImageName, $qr);

        //layoutnya bisa temen-temen sesuaiin sama kebutuhannya temen-temen
        return view('admin.pages.qr_code.scanner', compact('code'));
    }
}
