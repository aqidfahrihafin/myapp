@extends('layouts.app')
@section('title', 'Hasil Pencarian Santri')
@section('content')
<h2 class="text-center text-primary">Detail Data Santri</h2>
<div class="card mt-4 p-4">
    <div class="card-body">
        <div class="text-center mb-3">
            @if($santri->image)
                <img src="{{ asset('storage/' . $santri->image) }}" alt="Foto Santri" class="rounded-circle border" width="150">
            @else
                <img src="https://via.placeholder.com/150" alt="Foto Default" class="rounded-circle border">
            @endif
        </div>
        <table class="table table-striped table-hover">
            <tr>
                <th>Nama Santri</th>
                <td>{{ $santri->nama }}</td>
            </tr>
            <tr>
                <th>NIS</th>
                <td>{{ $santri->nis }}</td>
            </tr>
            <tr>
                <th>NIK</th>
                <td>{{ $santri->nik }}</td>
            </tr>
            <tr>
                <th>No. KK</th>
                <td>{{ $santri->no_kk }}</td>
            </tr>
            <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>{{ $santri->tempat_lahir }}, {{ \Carbon\Carbon::parse($santri->tanggal_lahir)->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ ucfirst($santri->jenis_kelamin) }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $santri->alamat }}</td>
            </tr>
            <tr>
                <th>Nama Wali</th>
                <td>{{ $santri->nama_wali }}</td>
            </tr>
            <tr>
                <th>Hubungan Wali</th>
                <td>{{ $santri->hubungan_wali }}</td>
            </tr>
            <tr>
                <th>Kamar</th>
                <td>{{ $santri->kamar->nama_kamar ?? '-' }}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>{{ $santri->periode->nama_periode ?? '-' }}</td>
            </tr>
            <tr>
                <th>Persentase Tagihan</th>
                <td>{{ $santri->persentaseTagihan->potongan ?? '-' }}%</td>
            </tr>
            <tr>
                <th>Status Santri</th>
                <td>
                    <span class="badge bg-{{ $santri->status_santri == 'aktif' ? 'success' : ($santri->status_santri == 'non-aktif' ? 'danger' : 'warning') }}">
                        {{ ucfirst($santri->status_santri) }}
                    </span>
                </td>
            </tr>
        </table>
        <a href="{{ route('santri.index') }}" class="btn btn-secondary w-100 mt-3">Cari Lagi</a>
    </div>
</div>
@endsection
