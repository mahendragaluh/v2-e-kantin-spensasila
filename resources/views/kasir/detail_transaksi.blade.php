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
                            <h1 class="m-0">Detail Transaksi</h1>
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
                                    <h3 class="card-title">View Data Transaksi</h3>
                                </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <h4><b>Detail Pesanan {{ $order->nama_pelanggan }}</b></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <table>
                                                <tr>
                                                    <th>No Invoice</th>
                                                    <td>:</td>
                                                    <td>{{ $order->invoice }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Waktu Order</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F Y H:i') }}</td>
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
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="p-2"><a
                                                            href="{{ route('kasir.transaksi.konfirmasi', ['id' => $order->id]) }}"
                                                            onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?')"
                                                            class="btn btn-primary mt-1">Proses</a><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-8">
                                            <table id="datatabel-users-keranjang" class="table table-bordered projects">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20%">Nama Menu</th>
                                                        <th style="width: 20%">Harga</th>
                                                        <th style="width: 20%">Jumlah</th>
                                                        <th style="width: 20%">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($detail as $o)
                                                        <tr>
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
                                    <div class="row mt-3">

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
