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
                            <h1 class="m-0">Menu</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#modal-insert-menu">
                                    <i class="fa fa-plus"></i>
                                    Tambah Menu
                                </button>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="modal fade" id="modal-insert-menu">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('pengelola.store.menu') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Menu</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="namaMenu">Nama Menu</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="namaMenu" name="nama_menu"
                                                value="" placeholder="Isi Nama Menu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="jenisMenu">Jenis Menu</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="jenisMenu" name="jenis_menu_id">
                                                <option>Jenis Menu</option>
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                                <option value="3">Snack</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="hargaMenu">Harga Menu</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="hargaMenu" name="harga_menu"
                                                value="" placeholder="Isi Harga Menu">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="fotoMenu">Foto Menu</label>
                                        <div class="col-sm-8 input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fotoMenu" name="foto_menu">
                                                <label class="custom-file-label" for="fotoMenu">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="statusMenu">Stok Menu</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="stokMenu" name="stok_menu"
                                                value="" placeholder="Isi Stok Menu">
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
                                    <h3 class="card-title">View Data Menu</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatabel-users" class="table table-bordered table-striped projects">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No.</th>
                                                    <th style="width: 15%">Foto Menu</th>
                                                    <th style="width: 15%">Nama Menu</th>
                                                    <th style="width: 15%">Jenis Menu</th>
                                                    <th style="width: 10%">Harga</th>
                                                    <th style="width: 10%">Stok</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($menus as $menu)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><img src="{{ asset('storage/' . $menu->foto_menu) }}"
                                                                style="width: 150px" alt="Foto Menu"></td>
                                                        <td>{{ $menu->nama_menu }}</td>
                                                        <td>{{ $menu->kategori }}</td>
                                                        <td>Rp{{ number_format($menu->harga_menu, 2, ',', '.') }}</td>
                                                        {{-- <td><span class="badge badge-{{ $menu->status_menu ? 'success':'danger'   }}">{{ $menu->status_menu ? 'Tersedia' : 'Tidak Tersedia' }}</span></td> --}}
                                                        <td>
                                                            @if ($menu->stok_menu == 0)
                                                                <span class="badge bg-danger">Habis</span>
                                                            @else
                                                                {{ $menu->stok_menu }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                                action="{{ route('pengelola.destroy.menu', $menu->id) }}"
                                                                method="POST">
                                                                <a href="{{ route('pengelola.edit.menu', ['id' => $menu->id]) }}"
                                                                    class="btn btn-sm btn-primary mb-1 mt-1">EDIT</a>
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
                                                    <th>Foto Menu</th>
                                                    <th>Nama Menu</th>
                                                    <th>Jenis Menu</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
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
@endsection
