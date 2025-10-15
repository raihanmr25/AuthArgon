<?php

namespace App\Http\Controllers;

use App\Models\BarangPemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\Facades\DNS1DFacade;

class BarangPemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangPemakaians = BarangPemakaian::all();
        return view('barang.index', compact('barangPemakaians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nibar' => 'required|string|max:255|unique:barang_pemakaian',
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'tahun_perolehan' => 'required|integer',
            'lokasi' => 'nullable|string|max:255',
            'nama_pemakai' => 'nullable|string|max:255',
            'status_pemakai' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kondisi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $barcode = DNS1DFacade::getBarcodePNG($validated['nibar'], 'C128');
        $barcode_path = 'barcodes/' . $validated['nibar'] . '.png';
        Storage::disk('public')->put($barcode_path, base64_decode($barcode));
        $validated['barcode'] = $barcode_path;

        BarangPemakaian::create($validated);

        return redirect()->route('barang.index')->with('success', 'Asset created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangPemakaian $barangPemakaian)
    {
        return view('barang.show', compact('barangPemakaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangPemakaian $barangPemakaian)
    {
        return view('barang.edit', compact('barangPemakaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangPemakaian $barangPemakaian)
    {
        // --- THIS IS THE UPDATED SECTION ---
        // The validation rules have been expanded to allow all relevant fields to be updated.
        // 'sometimes' means the field is only validated if it's present in the request.
        $validated = $request->validate([
            'nibar' => 'sometimes|string|max:255',
            'kode_barang' => 'sometimes|string|max:255',
            'nama_barang' => 'sometimes|string|max:255',
            'merk' => 'sometimes|string|max:255',
            'tahun_perolehan' => 'sometimes|integer',
            'lokasi' => 'nullable|string|max:255',
            'nama_pemakai' => 'nullable|string|max:255',
            'status_pemakai' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kondisi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        // --- END OF CHANGE ---

        $barangPemakaian->update($validated);

        // This function now returns JSON, which is better for API requests from the mobile app.
        return response()->json([
            'message' => 'Asset updated successfully!',
            'data' => $barangPemakaian->fresh() // ->fresh() reloads the model from the database
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangPemakaian $barangPemakaian)
    {
        if ($barangPemakaian->barcode && Storage::disk('public')->exists($barangPemakaian->barcode)) {
            Storage::disk('public')->delete($barangPemakaian->barcode);
        }
        $barangPemakaian->delete();
        return redirect()->route('barang.index')->with('success', 'Asset deleted successfully!');
    }
    
    // API function to find an asset by barcode or nibar
    public function find($code)
    {
        $asset = BarangPemakaian::where('nibar', $code)->orWhere('barcode', 'like', '%' . $code . '%')->first();

        if ($asset) {
            return response()->json(['data' => $asset]);
        }

        return response()->json(['message' => 'Asset not found'], 404);
    }
}