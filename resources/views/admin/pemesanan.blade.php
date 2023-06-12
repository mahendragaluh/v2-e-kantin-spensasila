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
                            <h1 class="m-0">Pemesanan</h1>
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
                        @csrf
                        <div class="col-md-8">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">View Data Pemesanan</h3>
                                </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered projects">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%">Foto Menu</th>
                                                    <th style="width: 15%">Menu</th>
                                                    <th style="width: 15%">Harga</th>
                                                    <th style="width: 15%">Jumlah</th>
                                                    <th style="width: 15%">Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $subtotal=0; foreach($keranjangs as $keranjang): ?>
                                                <tr>
                                                    <td><img src="{{ asset('/assets/img/menu/' . $keranjang->foto_menu) }}"
                                                            style="width: 150px" alt="Foto Menu"></td>
                                                    <td>{{ $keranjang->nama_menu }}</td>
                                                    <td>Rp{{ number_format($keranjang->harga_menu, 2, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group">
                                                            <form
                                                                action="{{ route('keranjang.update', $keranjang->id_keranjang) }}"
                                                                method="post">
                                                                @method('patch')
                                                                @csrf()
                                                                <input type="hidden" name="param" value="kurang">
                                                                <button class="btn btn-primary btn-sm">
                                                                    -
                                                                </button>
                                                            </form>
                                                            <button class="btn btn-outline-primary btn-sm" disabled="true">
                                                                {{ number_format($keranjang->qty) }}
                                                            </button>
                                                            <form
                                                                action="{{ route('keranjang.update', $keranjang->id_keranjang) }}"
                                                                method="post">
                                                                @method('patch')
                                                                @csrf()
                                                                <input type="hidden" name="param" value="tambah">
                                                                <button class="btn btn-primary btn-sm">
                                                                    +
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <?php
                                                    $total = $keranjang->harga_menu * $keranjang->qty;
                                                    $subtotal = $subtotal + $total;
                                                    ?>
                                                    <td>Rp{{ number_format($total, 2, ',', '.') }}</td>
                                                </tr>
                                                <?php endforeach;?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th style="width: 15%">Foto Menu</th>
                                                    <th style="width: 15%">Menu</th>
                                                    <th style="width: 15%">Harga</th>
                                                    <th style="width: 15%">Jumlah</th>
                                                    <th style="width: 15%">Total</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 text-right border-bottom mb-3">
                                            <h3 class="text-black h4 text-uppercase">Total Harga</h3>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <span class="text-black">Total</span>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <strong class="text-black">Rp.
                                                {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{route('user.checkout')}}" class="btn btn-primary py-3 btn-block">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
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
