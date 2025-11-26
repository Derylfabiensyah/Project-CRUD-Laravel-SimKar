@extends('templates.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 1.5rem;">
        <h3 class="card-title mb-0">Daftar Karyawan</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formpenggajian">
            <i class="bi bi-plus-circle"></i> Tambah Penggajian
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
                    <th>ID Karyawan</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Tanggal Transfer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ct)
                <tr>
                    <td>{{ $ct->id_gaji }}</td>
                    <td>{{ $ct->id_karyawan }}</td>
                    <td>{{ $ct->bulan }}</td>
                    <td>{{ $ct->tahun }}</td>
                    <td>{{ $ct->gaji_pokok }}</td>
                    <td>{{ $ct->tunjangan }}</td>
                    <td>{{ $ct->potongan }}</td>
                    <td>{{ $ct->total_gaji }}</td>
                    <td>{{ $ct->tanggal_transfer }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editpenggajianModal{{ $ct->id_gaji }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>

                        <form action="{{ route('penggajian.destroy', $ct->id_gaji) }}" 
                              method="POST" 
                              style="display:inline"
                              onsubmit="return confirm('Yakin hapus data gaji ID {{ $ct->id_gaji }}?')">
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

    <!-- MODAL TAMBAH PENGGAJIAN -->
    <div class="modal fade" id="formpenggajian" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penggajian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('penggajian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">ID Karyawan</label>
                            <input type="number" class="form-control" name="id_karyawan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bulan</label>
                            <input type="text" class="form-control" name="bulan" placeholder="Januari" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" class="form-control" name="tahun" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gaji Pokok</label>
                            <input type="number" class="form-control" name="gaji_pokok" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tunjangan</label>
                            <input type="number" class="form-control" name="tunjangan" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Potongan</label>
                            <input type="number" class="form-control" name="potongan" value="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Transfer</label>
                            <input type="date" class="form-control" name="tanggal_transfer">
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

<!-- Modal Edit Penggajian (letakkan di luar loop) -->
@foreach ($data as $ct)
<div class="modal fade" id="editpenggajianModal{{ $ct->id_gaji }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penggajian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('penggajian.update', $ct->id_gaji) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">ID Karyawan</label>
                        <input type="number" name="id_karyawan" value="{{ $ct->id_karyawan }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" name="bulan" value="{{ $ct->bulan }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" value="{{ $ct->tahun }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" value="{{ $ct->gaji_pokok }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tunjangan</label>
                        <input type="number" name="tunjangan" value="{{ $ct->tunjangan }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Potongan</label>
                        <input type="number" name="potongan" value="{{ $ct->potongan }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Transfer</label>
                        <input type="date" name="tanggal_transfer" value="{{ $ct->tanggal_transfer }}" class="form-control">
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
