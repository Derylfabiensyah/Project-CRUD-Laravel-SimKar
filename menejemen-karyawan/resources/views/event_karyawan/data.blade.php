@extends('templates.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 1.5rem;">
        <h3 class="card-title mb-0">Daftar Event Karyawan</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formEvent">
            <i class="bi bi-plus-circle"></i> Tambah Event
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
                    <th>Id Event</th>
                    <th>Id Karyawan</th>
                    <th>Jenis Event</th>
                    <th>Keterangan</th>
                    <th>Tanggal Event</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ct)
                @php
                  $eid = $ct->id ?? $ct->id_event;
                @endphp
                <tr>
                    <td>{{ $eid }}</td>
                    <td>{{ $ct->id_karyawan ?? '-' }}</td>
                    <td>{{ $ct->jenis_event }}</td>
                    <td>{{ $ct->keterangan }}</td>
                    <td>{{ $ct->tanggal_event }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal{{ $eid }}">
                            <i class="bi bi-pencil"></i> Edit
                        </button>

                        <form action="{{ route('event.destroy', $eid) }}" 
                              method="POST" 
                              style="display:inline"
                              onsubmit="return confirm('Yakin hapus {{ $ct->jenis_event }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editEventModal{{ $eid }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form action="{{ route('event.update', $eid) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Id Karyawan</label>
                            <input type="text" name="id_karyawan" value="{{ $ct->id_karyawan }}" class="form-control" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Jenis Event</label>
                            <input type="text" name="jenis_event" value="{{ $ct->jenis_event }}" class="form-control" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Keterangan</label>
                              <input type="text" name="keterangan" value="{{ $ct->keterangan }}" class="form-control" required>
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Tanggal Event</label>
                              <input type="date" name="tanggal_event" value="{{ $ct->tanggal_event }}" class="form-control" required>
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
            </tbody>
        </table>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" id="formEvent" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form action="{{ route('event.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Id Karyawan</label>
                  <input type="text" name="id_karyawan" value="{{ old('id_karyawan') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Jenis Event</label>
                  <input type="text" name="jenis_event" value="{{ old('jenis_event') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Event</label>
                    <input type="date" name="tanggal_event" value="{{ old('tanggal_event') }}" class="form-control" required>
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
@endsection
