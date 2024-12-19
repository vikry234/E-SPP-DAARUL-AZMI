<style>
  .main-sidebar {
    background-color: #144171;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link py-4">
    <img src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/dist/img/logoDA.png" alt="Logo" class="image" style="width: 50px;">
    <span class="brand-text font-weight-bold">E-SPP DAZMI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @role('admin')
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endrole

        @role('petugas')
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        @elserole('siswa')
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        @endrole

        @role('admin')
        <li class="nav-header">MANAJEMEN DATA</li>
        <li class="nav-item">
          <a href="{{ route('siswa.index') }}" class="nav-link {{ Request::segment(2) == 'siswa' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Siswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran-spp.index') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-spp' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::segment(2) == 'kelas' ? 'active' : '' }}">
            <i class="nav-icon fas fa-school"></i>
            <p>
              Kelas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('spp.index') }}" class="nav-link {{ Request::segment(2) == 'spp' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              SPP
            </p>
          </a>
        </li>
        @endrole

        @role('petugas')
        <li class="nav-header">MANAJEMEN DATA</li>
        <li class="nav-item">
          <a href="{{ route('siswa.index') }}" class="nav-link {{ Request::segment(2) == 'siswa' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Siswa
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran-spp.index') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-spp' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::segment(2) == 'kelas' ? 'active' : '' }}">
            <i class="nav-icon fas fa-school"></i>
            <p>
              Kelas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('spp.index') }}" class="nav-link {{ Request::segment(2) == 'spp' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              SPP
            </p>
          </a>
        </li>
        @endrole

        @role('admin|petugas')
        <li class="nav-header">PEMBAYARAN</li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::segment(2) == 'bayar' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.status-pembayaran') }}" class="nav-link {{ Request::segment(2) == 'status-pembayaran' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Status Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.history-pembayaran') }}" class="nav-link {{ Request::segment(2) == 'history-pembayaran' ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
              History Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.laporan') }}" class="nav-link {{ Request::segment(2) == 'laporan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Laporan Pembayaran
            </p>
          </a>
        </li>
        @endrole
        <li class="nav-item text-center py-4">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-sign-out-alt mr-2"></i>Logout</button>
          </form>
        </li>
        @role('siswa')
        <li class="nav-header">PEMBAYARAN</li>
        <li class="nav-item">
          <a href="{{ route('siswa.pembayaran-spp') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-spp' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('siswa.history-pembayaran') }}" class="nav-link {{ Request::is('siswa/history-pembayaran') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
              History Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('siswa.laporan-pembayaran') }}" class="nav-link {{ Request::is('siswa/laporan-pembayaran') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        @endrole
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>