<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SimKar | Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <meta name="title" content="SimKar | Dashboard" />
    <meta name="author" content="Rico Elvis" />
    <meta name="description" content="SimKar — A modern Point of Sale web application for managing sales, inventory, and customers efficiently." />
    <meta name="keywords" content="SimKar, point of sale, kasir online, admin dashboard, sales management, inventory system, Bootstrap 5, AdminLTE" />

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!-- Bootstrap 5.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">

    <!-- AdminLTE 4 CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack('styles')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('assets/img/rico.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">Rico Elvis</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-secondary">
                  <img
                    src="{{ asset('assets/img/rico.jpg') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Rico Elvis - Manager
                    <small>In position since Jul. 2018</small>
                  </p>
                </li>
                <!--end::User Image-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <a href="/home" class="brand-link d-flex align-items-center gap-2">
            <i class="bi bi-people-fill fs-2" style="color: #4e73df;"></i>
            <span class="brand-text fw-bold fs-4">SimKar</span>
          </a>
        </div>
        <!--end::Sidebar Brand-->

        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="/" class="nav-link">
                  <i class="nav-icon bi bi-house-door"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/departemen" class="nav-link">
                  <i class="nav-icon bi bi-building"></i>
                  <p>Departemen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/karyawan" class="nav-link">
                  <i class="nav-icon bi bi-people-fill"></i>
                  <p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/event" class="nav-link">
                  <i class="nav-icon bi bi-calendar-event"></i>
                  <p>Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/absensi" class="nav-link">
                  <i class="nav-icon bi bi-calendar-check"></i>
                  <p>Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/penggajian" class="nav-link">
                  <i class="nav-icon bi bi-cash-stack"></i>
                  <p>Penggajian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/jadwal_kerja" class="nav-link">
                  <i class="nav-icon bi bi-clock-history"></i>
                  <p>Jadwal Kerja</p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">@yield('title')</h3>
              </div>
            </div>
          </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <div class="container-fluid">
            @yield('content')
          </div>
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <!--begin::Footer-->
      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Everything You Are</div>
        <strong>
          Copyright &copy; 2014-2025&nbsp;
          <a href="https://github.com/Derylfabiensyah" class="text-decoration-none">Rico Elvis</a>.
        </strong>
        All rights reserved.
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap 5.2 JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

    @stack('scripts')
  </body>
  <!--end::Body-->
</html>