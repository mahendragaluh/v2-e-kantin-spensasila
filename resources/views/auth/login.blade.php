<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Kantin SMP | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
        @endif

        <div class="login-logo">
            <a href="#">
                <b>E-KANTIN</b> SMP NEGERI 1 SILIRAGUNG
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk sebagai pengguna terdaftar</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group form-group mb-3">
                        <input type="nisn" name="nisn" class="form-control" value="{{ old('nisn') }}"
                            placeholder="NISN" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group form-group mb-3">
                        <input id="inputPassword" type="password" name="password" class="form-control"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span id="passwordToggle" class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <button type="submit" class="btn btn-block btn-primary">
                            Sign In
                        </button>
                        <a href="/" class="btn btn-block btn-danger">
                            Back
                        </a>
                    </div>
                    <!-- /.social-auth-links -->
                </form>

                <p class="mb-0">
                    <a href="/register" class="text-center">Belum memiliki akun? Daftar sekarang!</a>
                </p>

                <p class="mb-1">
                    <a href="#">Lupa Password?</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>

    <script>
        let isPasswordVisible = false;

        $('#passwordToggle').on('click', function() {
            isPasswordVisible = !isPasswordVisible;

            if (isPasswordVisible) {
                $('#inputPassword').attr('type', 'text');
                $('#passwordToggle').removeClass('fa-eye');
                $('#passwordToggle').addClass('fa-eye-slash');
            } else {
                $('#inputPassword').attr('type', 'password');
                $('#passwordToggle').removeClass('fa-eye-slash');
                $('#passwordToggle').addClass('fa-eye');
            }
        });
    </script>

</body>

</html>
