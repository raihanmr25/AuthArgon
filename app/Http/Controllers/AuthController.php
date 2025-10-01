<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\BarangPemakaian;


class AuthController extends Controller
{
    
   public function register(Request $request)
{
    // Validasi data registrasi
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/^[A-Z]/', // Password harus diawali huruf kapital
            'regex:/[!@#$%^&*(),.?":{}|<>]/', // Harus mengandung karakter spesial
            'confirmed'
        ],
    ], [
        'password.regex' => 'Password harus diawali huruf besar dan mengandung karakter spesial.'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Simpan user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return view('auth.login');
}
    public function login(Request $request)
    {

        $jumlah = BarangPemakaian::count();
        $todayItems = BarangPemakaian::whereDate('created_at', Carbon::today())->take(5)->get();
        // $notifications = BarangPemakaian::latest()->take(5)->get(); // ambil 5 notifikasi terbaru
        // $deletedItems = BarangPemakaian::onlyTrashed()->whereDate('deleted_at', $today)->get();
        $notifications = BarangPemakaian::latest()->take(5)->get();

        // Validate login data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt to login using email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

        return view('dashboard', compact('user', 'jumlah', 'todayItems', 'notifications'));

        }

        return response()->json(['error' => 'Invalid credentials'], 401);
        
    }

    public function logout(Request $request)
    {

        Auth::logout();

        return view('auth.login');

    }

       public function dashboard()
    {
        // Contoh data yang bisa dikirim ke view dashboard (jika diperlukan)
        $items = BarangPemakaian::all();
        $jumlah = BarangPemakaian::count();
        $todayItems = BarangPemakaian::whereDate('created_at', Carbon::today())->get();
        
        // return view('dashboard', compact('items'));

        return view('dashboard', [

            'items'         => $items,
            'jumlah'        => $jumlah,
            'todayItems'   => $todayItems,
            
        ]);
    }

}
