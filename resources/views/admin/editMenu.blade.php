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
                            <h1 class="m-0">Edit Menu</h1>
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">View Edit Menu</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="{{ route('update.menu', ['id' => $menus->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="namaMenu">Nama Menu</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="namaMenu" name="nama_menu"
                                                    value="{{ $menus->nama_menu }}" placeholder="Isi Nama Menu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="jenisMenu">Jenis Menu</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="jenisMenu" name="jenis_menu_id">
                                                    <option>Jenis Menu</option>
                                                    @foreach ($jenis_menus as $jm)
                                                        <option value="{{ $jm->id }}" <?php if ($menus->jenis_menu_id == $jm->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $jm->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="hargaMenu">Harga Menu</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="hargaMenu" name="harga_menu"
                                                    value="{{ $menus->harga_menu }}" placeholder="Isi Harga Menu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="fotoMenu">Foto Menu</label>
                                            <div class="col-sm-8 input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fotoMenu"
                                                        name="foto_menu">
                                                    <label class="custom-file-label" for="fotoMenu">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="showFotoMenu"></label>
                                            <div class="col-sm-8 input-group">
                                                <img src="{{ asset('/assets/img/menu/' . $menus->foto_menu) }}" height="100%"
                                                    width="100%" alt="" srcset="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="stokMenu">Stok Menu</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="stokMenu" name="stok_menu"
                                                    value="{{ $menus->stok_menu }}" placeholder="Isi Stok Menu">
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

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    @endauth
@endsection
