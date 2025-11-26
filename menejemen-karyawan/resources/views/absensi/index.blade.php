@extends('templates.layout')

@section('title', 'Absensi Pages')

@section('content')
<div class="container mt-3">

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

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Absensi</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAbsensiModal">
            <i class="bi bi-plus-circle"></i> Tambah Absensi
        </button>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $abs)
                <tr>
                    <td>{{ $abs->id }}</td>
                    <td>{{ $abs->karyawan->nama_karyawan ?? '-' }}</td>
                    <td>{{ $abs->tanggal_absensi }}</td>
                    <td>{{ $abs->jam_masuk }}</td>
                    <td>{{ $abs->jam_keluar }}</td>
                    <td>{{ $abs->status }}</td>

                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editAbsensiModal{{ $abs->id }}">
                            Edit
                        </button>

                        <form action="{{ route('absensi.destroy', $abs->id) }}" 
                              method="POST" style="display:inline"
                            onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editAbsensiModal{{ $abs->id }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Absensi</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form action="{{ route('absensi.update', $abs->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Karyawan</label>
                                <select name="id_karyawan" class="form-control">
                                    @foreach ($karyawan as $k)
                                    <option value="{{ $k->id }}"
                                        {{ $abs->id_karyawan == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_karyawan }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Absensi</label>
                                <input type="date" name="tanggal_absensi" 
                                       class="form-control" value="{{ $abs->tanggal_absensi }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam Masuk</label>
                                <input type="time" name="jam_masuk" 
                                       class="form-control" value="{{ $abs->jam_masuk }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam Keluar</label>
                                <input type="time" name="jam_keluar" 
                                       class="form-control" value="{{ $abs->jam_keluar }}">
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Status</label>
                              <select name="status" class="form-control">
                                  @foreach (['Hadir','Izin','Sakit','Alpha'] as $status)
                                      <option value="{{ $status }}" {{ $abs->status == $status ? 'selected' : '' }}>
                                          {{ $status }}
                                      </option>
                                  @endforeach
                              </select>
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button class="btn btn-primary">Update</button>
                        </div>

                      </form>

                    </div>
                  </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addAbsensiModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Absensi</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('absensi.store') }}" method="POST">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Karyawan</label>
                <select name="id_karyawan" class="form-control" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawan as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_karyawan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Absensi</label>
                <input type="date" name="tanggal_absensi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Masuk</label>
                <input type="time" name="jam_masuk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Keluar</label>
                <input type="time" name="jam_keluar" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <p>I have fixed the undefined variable error in the absensi view by consolidating the logic from `data.blade.php` into `index.blade.php`. This involved moving the entire card layout, including the table and modals for adding/editing absensi, into the main `index.blade.php` file. I also ensured that the controller passes all necessary data (`data` and `karyawan`) to this unified view.
                    <option value="Sakit">Sakit</option>
                    <option value="Alpha">Alpha</option>
                </select>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>

</div>
@endsection