@extends('layouts.app')
@section('title', 'Cek Saldo Santri')
@section('content')
<h2 class="text-center text-primary">Cek Saldo Santri</h2>
<div class="saldo-card mt-4">
    <p>Saldo Anda:</p>
    <p class="saldo-amount">Rp. 1.250.000</p>
</div>
<div class="mt-4 text-center">
    <button class="btn btn-success">Top Up Saldo</button>
    <button class="btn btn-danger">Riwayat Transaksi</button>
</div>
@endsection
