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
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <table id="datatabel-users-keranjang" class="table table-bordered projects">
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
                                                <td><img src="{{ asset('storage/' . $keranjang->foto_menu) }}"
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
                                                        @if ($keranjang->qty >= $keranjang->stock)
                                                            <form
                                                                action="{{ route('keranjang.update', $keranjang->id_keranjang) }}"
                                                                method="post">
                                                                @method('patch')
                                                                @csrf()
                                                                <input type="hidden" name="param" value="tambah">
                                                                <button class="btn btn-primary btn-sm" disabled>
                                                                    +
                                                                </button>
                                                            </form>
                                                        @else
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
                                                        @endif

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
                                    <div class="col-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <strong class="text-black">Rp.
                                            {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                    </div>
                                </div>
                                @if ($subtotal !== 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('user.checkout') }}"
                                                class="btn btn-primary py-3 btn-block">Checkout</a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
    </div>
@endsection
