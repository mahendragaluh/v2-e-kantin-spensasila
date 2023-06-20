<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/home" class="navbar-brand">
            <img src="{{ asset('/assets/img/logo-smp.png') }}" alt="Logo-SPENSASILA" class="brand-image"
                style="height: 50px">
            <span class="brand-text font-weight-light"><b>E-Kantin SPENSASILA</b></span>
        </a>

        {{-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/home" class="nav-link">Home</a>
                </li>
            </ul> --}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Notifications Dropdown Menu -->
            <?php
            $user_id = Auth::user()->id;
            $saldo = DB::table('saldos')
                ->select('saldos.*')
                ->where('user_id', $user_id)
                ->first();
            ?>

            <li class="nav-item">
                <a class="nav-link " href="#">
                    Saldo: <b>Rp{{ number_format($saldo->saldo, 2, ',', '.') }}</b>
                </a>
            </li>

            <?php
            $user_id = Auth::user()->id;
            $total_keranjang = DB::table('keranjangs')
                ->select(DB::raw('count(id) as jumlah'))
                ->where('user_id', $user_id)
                ->first();
            ?>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('keranjang.index') }}" role="button">
                    <i class="fas fa-cart-plus"></i>
                    <span class="badge badge-primary navbar-badge ms-2">{{ $total_keranjang->jumlah }}</span>
                </a>
            </li>
            <?php
            $user_id = Auth::user()->id;
            $total_order = DB::table('orders')
                ->select(DB::raw('count(id) as jumlah'))
                ->where('user_id', $user_id)
                ->where('keterangan', '=', 'Sedang Diproses')
                ->first();
            ?>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.order') }}" role="button">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-primary navbar-badge ms-2">{{ $total_order->jumlah }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.transaksi') }}" role="button">
                    <i class="fas fa-receipt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a id="dropdownKanan" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">
                    <i class="fas fa-user"></i>
                </a>
                <ul aria-labelledby="dropdownKanan" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>{{ Auth::user()->name }}</a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <li><a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <li class="dropdown-divider"></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->
