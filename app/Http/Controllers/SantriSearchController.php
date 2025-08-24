<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use Illuminate\Support\Facades\DB;

class SantriSearchController extends Controller
{
    // Menampilkan form pencarian santri
    public function index()
    {
        return view('pages.pencarian_santri');
    }

    // Proses pencarian santri berdasarkan NIS atau NIK
    public function search(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
        ]);

        $identifier = $request->input('identifier');

        $santri = Santri::where('nis', $identifier)
                        ->orWhere('nik', $identifier)
                        ->first();

        if (!$santri) {
            return redirect()->route('santri.index')->with('error', 'Data tidak ditemukan.');
        }

        // Simpan NIS dan foto ke session
        session([
            'nis_terpilih' => $santri->nis,
            'foto_santri' => $santri->image
        ]);

        return redirect()->route('santri.show', $santri->nis);
    }

    // Menampilkan detail santri
    public function show($nis)
    {
        $santri = Santri::where('nis', $nis)->firstOrFail();

        return view('pages.hasil_pencarian_santri', [
            'santri' => $santri,
        ]);
    }

    // Menampilkan saldo santri
    public function cekSaldo($nis)
    {
        $santri = Santri::where('nis', $nis)->firstOrFail();

        // Ambil saldo dari tabel 'saldos' berdasarkan user_id santri
        $saldo = DB::table('saldos')->where('user_id', $santri->user_id)->value('saldo');

        return view('pages.cek_saldo', [
            'santri' => $santri,
            'saldo' => $saldo ?? 0,
        ]);
    }
}
