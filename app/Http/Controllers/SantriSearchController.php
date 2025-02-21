<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;

class SantriSearchController extends Controller
{
    public function index()
{
    return view('pages.pencarian_santri'); // Sesuaikan dengan lokasi yang benar
}

public function search(Request $request)
{
    // Validasi input
    $request->validate([
        'identifier' => 'required|string',
    ]);

    $identifier = $request->input('identifier');

    // Cari data santri berdasarkan NIS atau NIK
    $santri = Santri::where('nis', $identifier)
                    ->orWhere('nik', $identifier)
                    ->first();

    // Jika data tidak ditemukan
    if (!$santri) {
        return redirect()->route('santri.index')->with('error', 'Data tidak ditemukan.');
    }

    // Tampilkan hasil pencarian
    return view('pages.hasil_pencarian_santri', compact('santri')); // Sesuaikan dengan lokasi yang benar
}
}