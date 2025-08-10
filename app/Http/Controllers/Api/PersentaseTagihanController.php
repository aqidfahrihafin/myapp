<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersentaseTagihan;
use Illuminate\Http\Request;

class PersentaseTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PersentaseTagihan::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_persentase' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $persentaseTagihan = PersentaseTagihan::create($data);

        return response()->json($persentaseTagihan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PersentaseTagihan $persentaseTagihan)
    {
        return $persentaseTagihan;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PersentaseTagihan $persentaseTagihan)
    {
        $data = $request->validate([
            'nama_persentase' => 'required|string|max:255',
            'persentase' => 'required|numeric|min:0|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $persentaseTagihan->update($data);

        return $persentaseTagihan;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersentaseTagihan $persentaseTagihan)
    {
        $persentaseTagihan->delete();

        return response()->json(['message' => 'Persentase tagihan deleted successfully']);
    }
}
