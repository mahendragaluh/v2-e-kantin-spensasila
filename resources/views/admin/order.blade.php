@extends('section.panel')

@section('content')
    @auth
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Order</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">Order</h3>
                                </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">Order Baru</h4>
                                    <p class="text-muted m-b-30 font-14">Silahkan pilih masakan</p>

                                    <div class="container w-full px-2 py-2 mx-auto col">
                                        <div class="grid lg:grid-cols-3 gap-y-5 row">
                                            @foreach ($menus as $menu)
                                                <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                                                    <div class="card bg-light d-flex flex-fill">
                                                        <img class="card-img-top" style="height: 200px"
                                                            src="{{ asset('/assets/img/menu/' . $menu->foto_menu) }}"
                                                            alt="Foto Menu">
                                                        <div class="card-body pt-2">
                                                            <div class="row-md-2">
                                                                <div class="text-center">
                                                                    <h4 class=""><b>{{ $menu->nama_menu }}</b></h4>
                                                                    <h5 class="">{{ $menu->jenis_menu }}</h5>
                                                                    <h5 class="">Rp{{ number_format($menu->harga_menu, 2, ',', '.') }}</h5>
                                                                    <h5 class="">Stok {{ $menu->stok_menu }}</h5>
                                                                    <form action="{{ route('user.keranjang.simpan') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @if (Route::has('login'))
                                                                            @auth
                                                                                <input type="hidden" name="user_id"
                                                                                    value="{{ Auth::user()->id }}">
                                                                            @endauth
                                                                        @endif
                                                                        <input type="hidden" name="menu_id"
                                                                            value="{{ $menu->id }}">
                                                                        <input type="hidden" name="qty" value="1">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Pesan</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @endauth
    <!-- Page specific script -->
@endsection
