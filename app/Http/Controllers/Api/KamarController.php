<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data kamar
        return Kamar::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'rayon_id' => 'required|exists:rayon,id',
        ]);

        $kamar = Kamar::create($data);

        return response()->json($kamar, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        return $kamar;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'nama_kamar' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'rayon_id' => 'required|exists:rayon,id',
        ]);

        $kamar->update($data);

        return $kamar;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return response()->json(['message' => 'Kamar deleted successfully']);
    }
}
