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
                            <h1 class="m-0">Pesanan Baru</h1>
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
                                    <table id="datatabel-users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 4%">No.</th>
                                                <th style="width: 12%">Invoice</th>
                                                <th style="width: 12%">Pemesan</th>
                                                <th style="width: 8%">Pembayaran</th>
                                                <th style="width: 10%">Subtotal</th>
                                                <th style="width: 10%">Status Order</th>
                                                <th style="width: 10%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderbaru as $o)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $o->invoice }}</td>
                                                    <td>{{ $o->nama_pemesan }}</td>
                                                    <td>{{ $o->pembayaran }}</td>
                                                    <td>Rp{{ number_format($o->subtotal, 2, ',', '.') }}</td>
                                                    <td><span class="badge bg-danger">{{ $o->name }}</span></td>
                                                    <td>
                                                        <a href="{{ route('kasir.transaksi.detail', ['id' => $o->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fa fa-edit"></i>
                                                            Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Invoice</th>
                                                <th>Pemesan</th>
                                                <th>Pembayaran</th>
                                                <th>Subtotal</th>
                                                <th>Status Order</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
