<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{ asset('img/logo/logo-penus2.png') }}" alt="SMK Plus Pelita Nusantara" style="width: 200px">
            {{-- <a href="index.html">Admin</a> --}}
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard-petugas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard-petugas') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Data Users</li>
            <li class="{{ Request::is('table-siswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-siswa') }}">
                    <i class="fas fa-user"></i>
                    <span>Siswa</span>
                </a>
            </li>
            <li class="{{ Request::is('table-petugas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-petugas') }}">
                    <i class="fas fa-user-tag"></i>
                    <span>Petugas</span>
                </a>
            </li>
            <li class="{{ Request::is('table-kelas') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-kelas') }}">
                    <i class="fas fa-user-group"></i>
                    <span>Kelas</span>
                </a>
            </li>
            <li class="{{ Request::is('table-jurusan') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-jurusan') }}">
                    <i class="fas fa-user-group"></i>
                    <span>Jurusan</span>
                </a>
            </li>

            <li class="menu-header">Data Pembayaran</li>
            <li class="{{ Request::is('table-spp') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-spp') }}">
                    <i class="fas fa-database"></i>
                    <span>Data SPP</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
