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
                            <h1 class="m-0">Isi Saldo</h1>
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
                        <div class="col-8">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <h3 class="card-title">View Data Transaksi</h3>
                                </div> --}}
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form onsubmit="return confirm('Apakah Data Yang Di Input Sudah Benar ?');" method="POST"
                                        action="{{ route('update.top_up', $users->id) }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="nisn">NISN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nisn" name="nisn"
                                                    value="{{ $users->nisn }}" placeholder="" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="saldo">Saldo</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="saldo" name="saldo"
                                                    value="" placeholder="Isi Saldo">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success text-right">Simpan</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
