<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lembaga::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $lembaga = Lembaga::create($data);

        return response()->json($lembaga, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lembaga $lembaga)
    {
        return $lembaga;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lembaga $lembaga)
    {
        $data = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $lembaga->update($data);

        return $lembaga;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lembaga $lembaga)
    {
        $lembaga->delete();

        return response()->json(['message' => 'Lembaga deleted successfully']);
    }
}
