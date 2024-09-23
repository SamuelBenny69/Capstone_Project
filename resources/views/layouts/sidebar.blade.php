<div class="sidebar">
<!-- Sidebar Menu -->
    <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }} ">
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
            <li class="nav-header">Absen</li>
            <li class="nav-item">
                <a href="{{ url('/absen') }}" class="nav-link {{ $activeMenu == 'absen' ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>Absen</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/laporan') }}" class="nav-link {{ $activeMenu == 'laporan' ? 'active' : '' }} ">
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
