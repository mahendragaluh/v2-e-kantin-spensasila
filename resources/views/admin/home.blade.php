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
                            <h1 class="m-0">Dashboard Admin</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">View Data Menu</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="container w-full px-2 py-2 mx-auto col">
                                        <div class="grid lg:grid-cols-3 gap-y-5 row">
                                            @foreach ($menus as $menu)
                                                <div class="col-12 col-sm-6 col-md-3 d-flex align-items-stretch flex-column">
                                                    <div class="card bg-light d-flex flex-fill">
                                                        <img class="card-img-top" style="height: 200px"
                                                            src="{{ asset('/assets/img/menu/' . $menu->foto_menu) }}"
                                                            alt="Dist Photo 3">
                                                        <div class="card-body pt-2">
                                                            <div class="row-md-2">
                                                                <div class="text-center">
                                                                    <h4 class=""><b>{{ $menu->nama_menu }}</b></h4>
                                                                    <h5 class="">{{ $menu->jenis_menu }}</h5>
                                                                    <h5 class="">Rp{{ $menu->harga_menu }}</h5>
                                                                    <h5 class="">{{ $menu->status_menu }}</h5>
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
                    </div>
                    <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @endauth
@endsection
