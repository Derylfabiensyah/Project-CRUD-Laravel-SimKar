@extends('templates.layout')

@section('content')
<div class="container mt-3">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Daftar Jadwal Kerja</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJadwalModal">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal Kerja
        </button>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Karyawan</th>
                    <th>Tanggal Kerja</th>
                    <th>Shift</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $ct)
                <tr>
                    <td>{{ $ct->id_jadwal }}</td>
                    <td>{{ $ct->karyawan->nama_karyawan ?? $ct->id_karyawan }}</td>
                    <td>{{ $ct->tanggal_kerja }}</td>
                    <td>{{ $ct->shift }}</td>
                    <td>{{ $ct->jam_mulai }}</td>
                    <td>{{ $ct->jam_selesai }}</td>

                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editJadwalModal{{ $ct->id_jadwal }}">
                            Edit
                        </button>

                        <form action="{{ route('jadwal_kerja.destroy', $ct->id_jadwal) }}" 
                              method="POST" style="display:inline"
                              onsubmit="return confirm('Yakin mau hapus jadwal kerja untuk {{ $ct->karyawan->nama_karyawan ?? $ct->id_karyawan }} pada {{ $ct->tanggal_kerja }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editJadwalModal{{ $ct->id_jadwal }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Jadwal Kerja</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form action="{{ route('jadwal_kerja.update', $ct->id_jadwal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label">Karyawan</label>
                                <select name="id_karyawan" class="form-control" required>
                                    @foreach ($karyawans as $k)
                                    <option value="{{ $k->id }}" {{ $ct->id_karyawan == $k->id ? 'selected' : '' }}>{{ $k->nama_karyawan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Kerja</label>
                                <input type="date" name="tanggal_kerja" class="form-control" value="{{ $ct->tanggal_kerja }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Shift</label>
                                <select name="shift" class="form-control" required>
                                    @foreach(['Pagi','Siang','Malam'] as $s)
                                        <option value="{{ $s }}" {{ $ct->shift == $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" value="{{ $ct->jam_mulai }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" value="{{ $ct->jam_selesai }}" required>
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
<div class="modal fade" id="addJadwalModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Tambah Jadwal Kerja</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('jadwal_kerja.store') }}" method="POST">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Karyawan</label>
                <select name="id_karyawan" class="form-control" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_karyawan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Kerja</label>
                <input type="date" name="tanggal_kerja" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Shift</label>
                <select name="shift" class="form-control" required>
                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Malam">Malam</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
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