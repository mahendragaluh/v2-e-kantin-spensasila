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
                            <h1 class="m-0">Top Up</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            @foreach ($users as $user)
                <div class="modal fade" id="modal-topUp-{{ $user->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form onsubmit="return confirm('Apakah Data Yang Di Input Sudah Benar ?');" method="POST"
                                action="{{ route('update.top_up', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Top Up</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="nisn">NISN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nisn" name="nisn"
                                                    value="{{ $user->nisn }}" placeholder="" disabled>
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
                                <div class="modal-footer justify-content-between">
                                    <a class="btn btn-default" data-dismiss="modal">Tutup</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            @endforeach

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
                                                <th style="width: 12%">NISN</th>
                                                <th style="width: 12%">Nama User</th>
                                                <th style="width: 8%">Kelas</th>
                                                <th style="width: 10%">No. Hp/Wa</th>
                                                <th style="width: 10%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->nisn }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->kelas }}</td>
                                                    <td>{{ $user->no_hp }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary mb-1 mt-1"
                                                            data-toggle="modal"
                                                            data-target="#modal-topUp-{{ $user->id }}">Top Up</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 4%">No.</th>
                                                <th style="width: 10%">NISN</th>
                                                <th style="width: 15%">Nama</th>
                                                <th style="width: 8%">Kelas</th>
                                                <th style="width: 10%">No. Hp/Wa</th>
                                                <th style="width: 10%">#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
