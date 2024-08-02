<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{ asset('img/logo/logo-penus2.png') }}" alt="SMK Plus Pelita Nusantara" style="width: 200px">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard-siswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('dashboard-siswa') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Data Pembayaran</li>
            <li class="{{ Request::is('spp-siswa') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('spp-siswa') }}">
                    <i class="fas fa-database"></i>
                    <span>Data SPP</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
