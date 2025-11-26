@extends('templates.layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 1.5rem;">
        <h3 class="card-title mb-0">Daftar Departemen</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formDepartemen">
            <i class="bi bi-plus-circle"></i> Tambah Departemen
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
                    <th>Nama Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ct)
                <tr>
                    <td>{{ $ct->id_departemen }}</td>
                    <td>{{ $ct->nama_departemen }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDepartemenModal{{ $ct->id_departemen }}">
                            <Edit class="bi bi-pencil">Edit
                        </button>

                        <form action="{{ route('departemen.destroy', $ct->id_departemen) }}" 
                              method="POST" 
                              style="display:inline"
                              onsubmit="return confirm('Yakin hapus {{ $ct->nama_departemen }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <Hapus class="bi bi-trash">Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                
                <!-- Modal Edit -->
                <div class="modal fade" id="editDepartemenModal{{ $ct->id_departemen }}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Departemen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form action="{{ route('departemen.update', $ct->id_departemen) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Nama Departemen</label>
                            <input type="text" name="nama_departemen" value="{{ $ct->nama_departemen }}" class="form-control" required>
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
    <div class="modal fade" id="formDepartemen" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Departemen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form action="{{ route('departemen.store') }}" method="POST">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Departemen</label>
                <input type="text" class="form-control" name="nama_departemen" required>
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
