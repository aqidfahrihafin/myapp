@extends('layouts.with-sidebar')

@section('title', 'Cek Saldo Santri')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-wallet2 me-2"></i>Saldo Santri
                </h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                <i class="bi bi-cash-stack text-primary display-3 mb-3"></i>
                <p class="text-muted mb-1">Saldo Anda Saat Ini</p>
                <h1 class="fw-bold text-primary mb-0">
                    Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
