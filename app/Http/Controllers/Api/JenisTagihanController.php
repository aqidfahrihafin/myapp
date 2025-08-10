<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisTagihan;
use Illuminate\Http\Request;

class JenisTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua jenis tagihan
        return JenisTagihan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisTagihan = JenisTagihan::create($data);

        return response()->json($jenisTagihan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisTagihan $jenisTagihan)
    {
        return $jenisTagihan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisTagihan $jenisTagihan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisTagihan->update($data);

        return $jenisTagihan;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisTagihan $jenisTagihan)
    {
        $jenisTagihan->delete();

        return response()->json(['message' => 'Jenis tagihan deleted successfully']);
    }
}
