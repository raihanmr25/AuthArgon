<?php
namespace App\Http\Controllers;

use App\Models\User;       // Model untuk Admin/User
use App\Models\Visitor;    // Model untuk visitor log (opsional)
use App\Models\BarangPemakaian;    // Model untuk visitor log (opsional)
use Carbon\Carbon;
use App\Models\Notifikasi; // pastikan modelnya sesuai 

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data yang bisa dikirim ke view dashboard (jika diperlukan)
        $items = BarangPemakaian::all();
        $jumlah = BarangPemakaian::count();
        $todayItems = BarangPemakaian::whereDate('created_at', Carbon::today())->take(5)->get();
        $notifications = BarangPemakaian::latest()->take(5)->get(); // ambil 5 notifikasi terbaru
        // $deletedItems = BarangPemakaian::onlyTrashed()->whereDate('deleted_at', $today)->get();
        
        // return view('dashboard', compact('items'));

        return view('dashboard', [
            'items'         => $items,
            'jumlah'        => $jumlah,
            'todayItems'   => $todayItems,
            'notifications' => $notifications,
        ]);
    }

    public function dashboard()
    {
        // Contoh data yang bisa dikirim ke view dashboard (jika diperlukan)
        $items = BarangPemakaian::all();
        $jumlah = BarangPemakaian::count();
        $todayItems = BarangPemakaian::whereDate('created_at', Carbon::today())->take(5)->get();

        
        // return view('dashboard', compact('items'));

        return view('dashboard', [

            'items'         => $items,
            'jumlah'        => $jumlah,
            'todayItems'   => $todayItems,
        ]);
    }

    public function item()
    {
        // Contoh data yang bisa dikirim ke view dashboard (jika diperlukan)
        $items = BarangPemakaian::all();
        
        // return view('dashboard', compact('items'));

        return view('barang.index', [

            'items'         => $items
        ]);
    }
}