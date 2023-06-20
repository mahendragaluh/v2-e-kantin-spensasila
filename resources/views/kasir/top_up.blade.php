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
                                                    <td>{{ $user->username_nisn }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->kelas }}</td>
                                                    <td>{{ $user->no_hp }}</td>
                                                    <td>
                                                        <a href="{{ route('add.top_up', ['id' => $user->id]) }}"
                                                            class="btn btn-sm btn-primary mb-1 mt-1">Top Up</a>
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
