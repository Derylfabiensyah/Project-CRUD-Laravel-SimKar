@extends('templates.layout')

@section('title', 'Home Page')

@section('content')
<div class="alert alert-secondary" role="alert">
  <h3 class="alert-heading">Selamat Datang di Aplikasi Manajemen Karyawan</h3>
  <p>Aplikasi ini memudahkan pengelolaan data karyawan, departemen, dan event seperti promosi, cuti, dan pelatihan melalui fitur CRUD yang lengkap dan terstruktur.</p>
</div>

<div style="display: flex; margin:auto; gap:20px;">
  <div class="small-box text-bg-success"  style="position:relative; width:350px; min-height:72px; padding:0.6rem;">
    <div class="inner">
      <h3>{{ $jumlah_karyawan ?? 0}}</h3>
      <p> Jumlah karyawan </p>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="small-box-icon" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
      <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
    </svg>
    <a
      href="{{ route('karyawan.index') }}"
      class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
    >
      Lihat Karyawan <i class="bi bi-link-45deg"></i>
    </a>
  </div>
  <div class="small-box text-bg-danger"  style="position:relative; width:350px; min-height:72px; padding:0.6rem;">
      <div class="inner">
        <h3>{{ $jumlah_event ?? 0}}</h3>
        <p> Jumlah Event </p>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" class="small-box-icon" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
      </svg>
      <a
        href="{{ route('event.index') }}"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat event <i class="bi bi-link-45deg"></i>
      </a>
  </div>
  <div class="small-box text-bg-secondary"  style="position:relative; width:350px; min-height:72px; padding:0.6rem;">
      <div class="inner">
        <h3>{{ $jumlah_absensi ?? 0}}</h3>
        <p> Jumlah Absensi </p>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" class="small-box-icon" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
        <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
      </svg>
      <a
        href="{{ route('absensi.index') }}"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat Absensi <i class="bi bi-link-45deg"></i>
      </a>
  </div>
</div>
@endsection