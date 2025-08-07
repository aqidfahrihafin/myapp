<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px;
            background-color: #f8f9fa;
            padding: 1.5rem 1rem;
            overflow-y: auto;
        }
        .content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 56px;
        }
        .foto-hover {
            cursor: pointer;
        }
        .modal-right .modal-dialog {
            position: fixed;
            right: 0;
            margin: 0;
            max-width: 400px;
            height: 100%;
        }
        .modal-right .modal-content {
            height: 100%;
            border: none;
            border-radius: 0;
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-dark bg-primary fixed-top px-4 d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="#">PP. Annuqayah</a>

    <div class="d-flex align-items-center gap-3">
        {{-- Tombol Cari --}}
        <a href="{{ route('santri.index') }}" class="text-white fs-5">
            <i class="bi bi-search"></i>
        </a>

        {{-- Foto Santri --}}
        @php
            $foto = session('foto_santri') ?? ($santri->image ?? null);
            $fotoPath = $foto ? (str_starts_with($foto, 'http') ? $foto : asset('storage/' . $foto)) : 'https://via.placeholder.com/40';
        @endphp

        <img src="{{ $fotoPath }}"
             alt="Foto Santri"
             class="rounded-circle border border-light foto-hover"
             style="width: 40px; height: 40px; object-fit: cover;"
             data-bs-toggle="modal"
             data-bs-target="#fotoSantriModal">
    </div>
</nav>

{{-- Sidebar --}}
<div class="sidebar shadow-sm">
    <a href="{{ session('nis_terpilih') ? route('santri.show', session('nis_terpilih')) : route('santri.index') }}"
       class="list-group-item list-group-item-action mb-2 
       {{ request()->routeIs('santri.show') ? 'active border-start border-primary border-4 fw-bold text-primary' : '' }}">
        <i class="bi bi-person-lines-fill me-2"></i> Data Santri
    </a>

    <a href="{{ route('cek.saldo') }}" 
       class="list-group-item list-group-item-action 
       {{ request()->routeIs('cek.saldo') ? 'active border-start border-primary border-4 fw-bold text-primary' : '' }}">
        <i class="bi bi-cash-stack me-2"></i> Cek Saldo
    </a>
</div>

{{-- Konten utama --}}
<div class="content">
    @yield('content')
</div>

{{-- Modal Foto Santri (kanan layar) --}}
<div class="modal fade modal-right" id="fotoSantriModal" tabindex="-1" aria-labelledby="fotoSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content bg-light p-4 d-flex flex-column align-items-center justify-content-center text-center">
            <img src="{{ $fotoPath }}"
                 alt="Foto Santri Besar"
                 class="img-fluid rounded-circle mb-3"
                 style="width: 200px; height: 200px; object-fit: cover;">
            <p class="fw-semibold">{{ session('nis_terpilih') ? 'NIS: ' . session('nis_terpilih') : 'Santri' }}</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
