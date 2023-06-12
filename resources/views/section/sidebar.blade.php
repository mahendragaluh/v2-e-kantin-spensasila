<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard-admin" class="brand-link">
        <img src="{{ asset('/assets/img/logo-smp.png') }}" alt="Logo SMP" class="brand-image">
        <span class="brand-text font-weight-light"><b>E-Kantin</b> SPENSASILA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-row align-items-center">
            <div class="image">
                <img style="width: 40px; height: 40px; object-fit: cover;"
                    src="{{ asset('assets/img/users/no-image.jpg') }}" class="img-circle elevation-2"
                    alt="{{ Auth::user()->name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <span class="right badge badge-success">
                    @if (Auth::user()->level_id == '1')
                        ADMINISTRATOR
                    @endif
                    @if (Auth::user()->level_id == '2')
                        KASIR
                    @endif
                    @if (Auth::user()->level_id == '3')
                        PENGELOLA
                    @endif
                </span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @if (Auth::user()->level_id == '1')
                    <li class="nav-item {{ request()->is('dashboard-admin*') ? 'active menu-open' : '' }}">
                        <a href="/dashboard-admin"
                            class="nav-link {{ request()->is('dashboard-admin*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ request()->is('menu*') ? 'active menu-open' : '' }}">
                        <a href="/menu" class="nav-link {{ request()->is('menu*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>
                                Menu
                            </p>
                        </a>
                    </li> --}}
                    <li
                        class="nav-item {{ request()->is('pengguna/users*') || request()->is('pengguna/level*') ? 'active menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('pengguna/users*') || request()->is('pengguna/level*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Pengguna
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pengguna.users') }}"
                                    class="nav-link {{ request()->is('pengguna/users*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pengguna.level') }}"
                                    class="nav-link {{ request()->is('pengguna/level*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Level</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->level_id == '2')
                    <li
                        class="nav-item {{ request()->is('kasir/transaksi/pesanan-baru') || request()->is('kasir/transaksi/selesai') ? 'active menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('kasir/transaksi*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Transaksi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kasir.transaksi') }}"
                                    class="nav-link {{ request()->is('kasir/transaksi/pesanan-baru*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pesanan Baru</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('kasir.transaksi.selesai') }}"
                                    class="nav-link {{ request()->is('kasir/transaksi/selesai') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Selesai</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->level_id == '3')
                    <li class="nav-item {{ request()->is('menu*') ? 'active menu-open' : '' }}">
                        <a href="/menu" class="nav-link {{ request()->is('menu*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>
                                Menu
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt nav-icon"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
