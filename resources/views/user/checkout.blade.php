@extends('layouts.user.master')

@section('content')
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
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h2>Detail Pesanan</h2>
                        <div class="card">
                            {{-- <div class="card-header">
                                    <h3 class="card-title">View Data Transaksi</h3>
                                </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('user.order.simpan') }}" method="post">
                                    @csrf
                                    <table class="table mb-5">
                                        <thead>
                                            <th>Menu</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <?php $subtotal = 0; ?>
                                            @foreach ($keranjangs as $keranjang)
                                                <tr>
                                                    <td>{{ $keranjang->nama_menu }} <strong class="mx-2">x</strong>
                                                        {{ $keranjang->qty }}</td>
                                                    <?php
                                                    $total = $keranjang->harga_menu * $keranjang->qty;
                                                    $subtotal = $subtotal + $total;
                                                    ?>
                                                    <td>Rp. {{ number_format($total, 2, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Jumlah Pembayaran</strong>
                                                </td>
                                                <td class="text-black font-weight-bold">
                                                    <strong>Rp. {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="invoice" value="{{ $invoice }}">
                                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    <div class="form-group">
                                        <label for="">Pilih Metode Pembayaran</label>
                                        <select name="metode_pembayaran_id" id="" class="form-control">
                                            <option value="1">Saldo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary py-3 btn-block" type="submit">Pesan
                                            Sekarang</button>
                                    </div>
                                </form>
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
    <!-- Page specific script -->
@endsection
