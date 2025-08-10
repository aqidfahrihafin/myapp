<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{

    public function index()
    {
        return Santri::with(['rayon', 'kamar', 'lembaga', 'periode', 'tagihan'])->get();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'rayon_id' => 'required|exists:rayon,id',
            'kamar_id' => 'required|exists:kamar,id',
            'lembaga_id' => 'required|exists:lembaga,id',
            'periode_id' => 'required|exists:periode,id',
        ]);

        $santri = Santri::create($data);
        return response()->json($santri->load(['rayon', 'kamar', 'lembaga', 'periode']), 201);
    }

    public function show(Santri $santri)
    {
        return $santri->load(['rayon', 'kamar', 'lembaga', 'periode', 'tagihan']);
    }

    public function update(Request $request, Santri $santri)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'rayon_id' => 'required|exists:rayon,id',
            'kamar_id' => 'required|exists:kamar,id',
            'lembaga_id' => 'required|exists:lembaga,id',
            'periode_id' => 'required|exists:periode,id',
        ]);

        $santri->update($data);
        return $santri->load(['rayon', 'kamar', 'lembaga', 'periode']);
    }

    public function destroy(Santri $santri)
    {
        $santri->delete();
        return response()->json(['message' => 'Deleted']);
    }

}
