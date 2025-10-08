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
    // ... (All your original functions like create, store, destroy, edit, update for the web are here and unchanged) ...
    public function create() { /* ... */ }
    public function store(Request $request) { /* ... */ }
    public function destroy($id) { /* ... */ }
    public function edit($id) { /* ... */ }
    public function update(Request $request, $id) { /* ... */ }


    /**
     * This is the FLEXIBLE search function for the API.
     */
    public function apiFindByCode($code)
    {
        // 1. Clean the incoming code to handle formatting differences
        $cleanedCode = str_replace(['.', ',', ' '], '', $code);

        // 2. First, try to find a match in the 'barcode' column
        $asset = BarangPemakaian::where('barcode', $code)->first();

        // 3. If not found, try to find a match in the 'nibar' column
        if (!$asset) {
            $asset = BarangPemakaian::whereRaw("REPLACE(REPLACE(nibar, '.', ''), ',', '') = ?", [$cleanedCode])
                                      ->first();
        }

        // 4. Return the result
        if (!$asset) {
            return response()->json(['error' => 'Asset not found'], 200);
        }

        return response()->json(['data' => $asset], 200);
    }

    /**
     * This is the RESTRICTED update function for the API.
     */
    public function apiUpdate(Request $request, BarangPemakaian $barangPemakaian)
    {
        // Validation is restricted to only these fields
        $validatedData = $request->validate([
            'lokasi' => 'sometimes|string|max:255',
            'nama_pemakai' => 'sometimes|string|max:255',
            'status_pemakai' => 'sometimes|string|max:255',
            'jabatan' => 'sometimes|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $barangPemakaian->update($validatedData);

        return response()->json(['message' => 'Asset updated successfully', 'data' => $barangPemakaian]);
    }
}