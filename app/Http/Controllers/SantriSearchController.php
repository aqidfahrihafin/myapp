<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;

class SantriSearchController extends Controller
{
    public function index()
    {
        return view('pages.pencarian_santri'); // Form pencarian santri
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required|string',
        ]);

        $identifier = $request->input('identifier');

        // Cari santri berdasarkan NIS atau NIK
        $santri = Santri::where('nis', $identifier)
                        ->orWhere('nik', $identifier)
                        ->first();

        // Jika tidak ditemukan
        if (!$santri) {
            return redirect()->route('santri.index')->with('error', 'Data tidak ditemukan.');
        }

        // Simpan NIS ke session agar bisa dipakai untuk menu navigasi
       session([
        'nis_terpilih' => $santri->nis,
        'foto_santri' => $santri->image
    ]);
        

        // Arahkan langsung ke halaman detail santri
        return redirect()->route('santri.show', $santri->nis);
    }

    public function show($nis)
    {
        $santri = Santri::where('nis', $nis)->firstOrFail();

        return view('pages.hasil_pencarian_santri', compact('santri'));
    }
}
