<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Kantin SMP | Register</title>

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

<body class="hold-transition register-page">
    <div class="register-box">

        @if ($errors->any())
            @foreach ($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
        @endif

        <div class="register-logo">
            <a href="#"><b>E-KANTIN</b> SMP NEGERI 1 SILIRAGUNG</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar sebagai pengguna baru</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="username" class="form-control" name="username" value="{{ old('username') }}"
                            placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="inputPasswordSignup" type="password" class="form-control" name="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span id="passwordToggleSignup" class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="inputConfPasswordSignup" type="password" class="form-control"
                            name="password_confirmation" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span id="confPasswordToggleSignup" class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center">
                        <button type="submit" class="btn btn-block btn-primary">
                            Sign up
                        </button>
                        <a href="/" class="btn btn-block btn-danger">
                            Back
                        </a>
                    </div>
                </form>
                <a href="/login" class="text-center">Sudah memiliki akun? Sign in sekarang!</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

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
        let isPasswordSignupVisible = false;
        let isConfPasswordSignupVisible = false;

        $('#passwordToggleSignup').on('click', function() {
            isPasswordSignupVisible = !isPasswordSignupVisible;
            console.log("password toggle");

            if (isPasswordSignupVisible) {
                $('#inputPasswordSignup').attr('type', 'text');
                $('#passwordToggleSignup').removeClass('fa-eye');
                $('#passwordToggleSignup').addClass('fa-eye-slash');
            } else {
                $('#inputPasswordSignup').attr('type', 'password');
                $('#passwordToggleSignup').removeClass('fa-eye-slash');
                $('#passwordToggleSignup').addClass('fa-eye');
            }
        });

        $('#confPasswordToggleSignup').on('click', function() {
            isConfPasswordSignupVisible = !isConfPasswordSignupVisible;
            console.log("conf password toggle");

            if (isConfPasswordSignupVisible) {
                $('#inputConfPasswordSignup').attr('type', 'text');
                $('#confPasswordToggleSignup').removeClass('fa-eye');
                $('#confPasswordToggleSignup').addClass('fa-eye-slash');
            } else {
                $('#inputConfPasswordSignup').attr('type', 'password');
                $('#confPasswordToggleSignup').removeClass('fa-eye-slash');
                $('#confPasswordToggleSignup').addClass('fa-eye');
            }
        });
    </script>

</body>

</html>
