@extends('layouts.user.master')

@section('content')
    @auth
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">

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
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <h2 class="display-5">Detail Pesanan Anda</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table>
                                                <tr>
                                                    <th>No Invoice</th>
                                                    <td>:</td>
                                                    <td>{{ $order->invoice }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status Pesanan</th>
                                                    <td>:</td>
                                                    <td><span class="badge bg-danger">{{ $order->status }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Metode Pembayaran</th>
                                                    <td>:</td>
                                                    <td>{{ $order->pembayaran }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Pembayaran</th>
                                                    <td>:</td>
                                                    <td>Rp
                                                        {{ number_format($order->subtotal, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="datatabel-users-keranjang" class="table table-bordered projects">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20%">Foto Menu</th>
                                                        <th style="width: 20%">Nama Menu</th>
                                                        <th style="width: 20%">Harga</th>
                                                        <th style="width: 20%">Jumlah</th>
                                                        <th style="width: 20%">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($detail as $o)
                                                        <tr>
                                                            <td><img src="{{ asset('storage/' . $o->foto_menu) }}"
                                                                    alt="Foto Menu" srcset="" width="150px"></td>
                                                            <td>{{ $o->nama_menu }}</td>
                                                            <td>Rp{{ number_format($o->harga_menu, 2, ',', '.') }}</td>
                                                            <td>{{ $o->qty }}</td>
                                                            <td>Rp{{ number_format($o->qty * $o->harga_menu, 2, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
