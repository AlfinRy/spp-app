<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{ asset('img/logo/logo-penus2.png') }}" alt="SMK Plus Pelita Nusantara" style="width: 200px">
            {{-- <a href="index.html">Admin</a> --}}
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            {{-- <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('dashboard-ecommerce-dashboard') }}">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li> --}}
            <li class="{{ Request::is('dashboard-admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard-admin') }}">
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
