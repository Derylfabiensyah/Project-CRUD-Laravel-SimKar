@extends('templates.layout')

@section('title', 'Karyawan Pages')

@section('content')
<div class="container mt-3">
    <h1>Karyawan Pages</h1> <!-- Tambahkan judul di sini -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @include('karyawan.data', ['data' => $data, 'departemens' => $departemens]) <!-- Pastikan untuk mengirimkan $departemens -->
</div>
@endsection
