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
                            <h1 class="m-0">Level</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#modal-tambah">
                                    <i class="fa fa-plus"></i>
                                    Level
                                </button>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('store.level') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Level</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="exampleInputEmail1">Nama Level</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="name_level"
                                                value="{{ old('name_level') }}" placeholder="Isi Nama Level">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <a class="btn btn-default" data-dismiss="modal">Close</a>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            @foreach ($levels as $data)
                <div class="modal fade" id="modal-edit-{{ $data->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('update.level', $data->id) }}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Level</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="exampleInputEmail1">Nama Level</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    name="name_level" value="{{ $data->name_level }}"
                                                    placeholder="Isi Nama Level">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <a class="btn btn-default" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                                <div class="card-header">
                                    <h3 class="card-title">View Data Level</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="datatabel-level" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 7%">No.</th>
                                                <th style="width: 20%">ID Level</th>
                                                <th style="width: 25%">Nama Level</th>
                                                <th style="width: 25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($levels as $level)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $level->id }}</td>
                                                    <td>{{ $level->name_level }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#modal-edit-{{ $level->id }}">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Level</th>
                                                <th>Nama Level</th>
                                                <th>Action</th>
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
@endsection
