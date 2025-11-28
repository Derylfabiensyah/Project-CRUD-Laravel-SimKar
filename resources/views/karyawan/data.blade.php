@extends('templates.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 1.5rem;">
        <h3 class="card-title mb-0">Daftar Karyawan</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formkaryawan">
            <i class="bi bi-plus-circle"></i> Tambah Karyawan
        </button>
    </div>

    <!-- Alert Success -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Alert Error -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ct)
                <tr>
                    <td>{{ $ct->id }}</td>
                    <td>{{ $ct->nama_karyawan }}</td>
                    <td>{{ $ct->jabatan }}</td>
                    <td>{{ $ct->departemen->nama_departemen ?? '-' }}</td>
                    <td>{{ $ct->tanggal_masuk }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editkaryawanModal{{ $ct->id }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>

                        <form action="{{ route('karyawan.destroy', $ct->id) }}" 
                              method="POST" 
                              style="display:inline"
                              onsubmit="return confirm('Yakin hapus {{ $ct->nama_karyawan }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="formkaryawan" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama_karyawan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departemen</label>
                            <select name="id_departemen" class="form-control" required>
                                <option value="">-- Pilih Departemen --</option>
                                @foreach ($departemens as $dept)
                                <option value="{{ $dept->id_departemen }}">{{ $dept->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit (letakkan di luar loop) -->
@foreach ($data as $ct)
<div class="modal fade" id="editkaryawanModal{{ $ct->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('karyawan.update', $ct->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" value="{{ $ct->nama_karyawan }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" value="{{ $ct->jabatan }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Departemen</label>
                        <select name="id_departemen" class="form-control" required>
                            <option value="">-- Pilih Departemen --</option>
                            @foreach ($departemens as $dept)
                            <option value="{{ $dept->id_departemen }}" {{ $ct->id_departemen == $dept->id_departemen ? 'selected' : '' }}>
                                {{ $dept->nama_departemen }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ $ct->tanggal_masuk }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
