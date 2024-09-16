<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link  {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-header">Data Perusahaan</li>
            <li class="nav-item">
                <a href="{{ url('/karyawan') }}" class="nav-link {{ $activeMenu == 'karyawan' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>Data Karyawan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/jabatan') }}" class="nav-link {{ $activeMenu == 'jabatan' ? 'active' : '' }}">
                    <i class="nav-icon far fa-user"></i>
                    <p>Jabatan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/gaji') }}" class="nav-link {{ $activeMenu == 'gaji' ? 'active' : '' }} ">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>Gaji</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/gaji-karyawan') }}" class="nav-link {{ $activeMenu == 'gaji-karyawan' ? 'active' : '' }} ">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>Gaji Karyawan</p>
                </a>
            </li>
            <li class="nav-header">Absens</li>
            <li class="nav-item">
                <a href="{{ url('/absens') }}" class="nav-link {{ $activeMenu == 'absens' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Absens</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/transaksi') }}" class="nav-link {{ $activeMenu == 'penjualan' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Laporan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link">
                    <button class="btn btn-block btn-danger">Log Out</button>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
