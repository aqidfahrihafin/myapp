@extends('layouts.app') {{-- tanpa sidebar --}}
@section('title', 'Pencarian Data Santri')
@section('content')
<h2 class="text-center text-primary">Pencarian Data Santri</h2>
@if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
<div class="card mt-4 p-4">
    <div class="card-body">
        <form action="{{ route('santri.search.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="identifier" class="form-label">Masukkan NIK atau NIS</label>
                <input type="text" name="identifier" id="identifier" class="form-control" placeholder="Contoh: 123456789" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cari Santri</button>
        </form>
    </div>
</div>
@endsection
