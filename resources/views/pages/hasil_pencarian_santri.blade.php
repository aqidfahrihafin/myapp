@extends('layouts.with-sidebar')

@section('title', 'Hasil Pencarian Santri')

@section('content')
<div class="container">
    <h2 class="text-center text-primary mb-4">
        <i class="bi bi-person-circle me-2"></i>Detail Data Santri
    </h2>

    <div class="card border-0 shadow rounded-4 p-4">
        <div class="card-body text-center">

            <!-- Foto Santri -->
            <div class="mb-4">
                @if($santri->image)
                    <img src="{{ asset('storage/' . $santri->image) }}"
                         alt="Foto Santri"
                         class="rounded-circle shadow border border-3 border-primary"
                         style="width: 160px; height: 160px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/160"
                         alt="Foto Default"
                         class="rounded-circle shadow border border-3 border-secondary"
                         style="width: 160px; height: 160px; object-fit: cover;">
                @endif
            </div>

            <!-- Data Tabel -->
            <div class="table-responsive mt-4">
                <table class="table table-borderless text-start">
                    <tbody class="fs-6">
                        <tr><th class="text-secondary w-50">Nama Santri</th><td class="fw-semibold">{{ $santri->nama }}</td></tr>
                        <tr><th class="text-secondary">NIS</th><td>{{ $santri->nis }}</td></tr>
                        <tr><th class="text-secondary">NIK</th><td>{{ $santri->nik }}</td></tr>
                        <tr><th class="text-secondary">No. KK</th><td>{{ $santri->no_kk }}</td></tr>
                        <tr><th class="text-secondary">Tempat, Tanggal Lahir</th><td>{{ $santri->tempat_lahir }}, {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
                        <tr><th class="text-secondary">Jenis Kelamin</th><td>{{ ucfirst($santri->jenis_kelamin) }}</td></tr>
                        <tr><th class="text-secondary">Alamat</th><td>{{ $santri->alamat }}</td></tr>
                        <tr><th class="text-secondary">Nama Wali</th><td>{{ $santri->nama_wali }}</td></tr>
                        <tr><th class="text-secondary">Hubungan Wali</th><td>{{ $santri->hubungan_wali }}</td></tr>
                        <tr><th class="text-secondary">Kamar</th><td>{{ $santri->kamar->nama_kamar ?? '-' }}</td></tr>
                        <tr><th class="text-secondary">Periode</th><td>{{ $santri->periode->nama_periode ?? '-' }}</td></tr>
                        <tr><th class="text-secondary">Persentase Tagihan</th><td>{{ $santri->persentaseTagihan->potongan ?? '-' }}%</td></tr>
                        <tr>
                            <th class="text-secondary">Status Santri</th>
                            <td>
                                <span class="badge px-3 py-2 bg-{{ 
                                    $santri->status_santri == 'aktif' ? 'success' : 
                                    ($santri->status_santri == 'non-aktif' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($santri->status_santri) }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('santri.index') }}" class="btn btn-outline-primary w-100 mt-4">
                <i class="bi bi-search me-1"></i> Cari Lagi
            </a>
        </div>
    </div>
</div>
@endsection
