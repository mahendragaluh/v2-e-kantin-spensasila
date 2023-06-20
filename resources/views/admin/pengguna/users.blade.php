@extends('section.panel')

@section('content')
    @auth
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-7">
                            <h1 class="m-0">Users</h1>
                            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-success">Import User Data</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-warning btn-block" href="{{ route('users.export') }}">Export User
                                            Data</a>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.col -->
                        <div class="col-sm-5">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#modal-membuat-user">
                                    <i class="fa fa-plus"></i>
                                    User
                                </button>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="modal fade" id="modal-membuat-user">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('create.users') }}">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Membuat User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="ID_Level">Jenis Level</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="ID_Level" name="level_id" required>
                                                <option>Jenis Level</option>
                                                <option value="1">Administrator</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Pengelola</option>
                                                <option value="4">Pengguna</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="IdSiswa">ID Siswa</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="IdSiswa" name="id_siswa"
                                                value="" placeholder="Isi ID Siswa" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="NISN">Username atau NISN</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="NISN" name="username_nisn"
                                                value="" placeholder="Isi Username atau NISN" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="NamaLengkap">Nama Lengkap</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="NamaLengkap" name="name"
                                                value="" placeholder="Isi Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="Kelas">Kelas</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="Kelas" name="kelas"
                                                value="" placeholder="Isi Kelas" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="NoHp">No. Hp/WA</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="NoHp" name="no_hp"
                                                value="" placeholder="Isi No. Hp/WA" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label" for="Password">Password</label>
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="Password" name="password"
                                                placeholder="Isi Password" required>
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

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">View Data Users</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatabel-users" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 7%">No.</th>
                                                    <th style="width: 7%">Level</th>
                                                    <th style="width: 10%">Username atau NISN</th>
                                                    <th style="width: 15%">Nama User</th>
                                                    <th style="width: 15%">Kelas</th>
                                                    <th style="width: 15%">No. HP/WA</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->level }}</td>
                                                        <td>{{ $user->username_nisn }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->kelas }}</td>
                                                        <td>{{ $user->no_hp }}</td>
                                                        <td>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('destroy.users', $user->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger mb-1 mt-1">HAPUS</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Level</th>
                                                    <th>Username atau NISN</th>
                                                    <th>Nama User</th>
                                                    <th>Kelas</th>
                                                    <th>No. HP/WA</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
