<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon/company.ico" type="image/x-icon">

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="./assets/css/libs.bundle.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.bundle.css">

    <!-- Title -->
    <title>Capstone</title>
</head>

<body>

    <!-- CONTENT -->
    <section class="bg-black">
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center gx-0 min-vh-100">
                <div class="col-12 col-md-6 col-lg-4 py-8 py-md-11">

                    <div class="col-7 col-md-11 col-lg-11 d-flex align-items-center mb-5">
                        <img src="assets/img/illustrations/logo-company.png" alt="logo" width="40"
                            class="me-3">
                        <!-- Text -->
                        <p class="mb-0 text-body-secondary">
                            Nama Perusahaan
                        </p>
                    </div>

                    <!-- Heading -->
                    <h1 class="mb-8 fw-bold text-white">
                        Sign in
                    </h1>

                    <!-- Form -->
                    <form class="mb-6" action="{{ url('login') }}" method="POST" id="form-login">
                        @csrf
                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label text-white" for="email">
                                Email Address
                            </label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@address.com">
                            <small id="error-username" class="error-text text-danger"></small>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label class="form-label text-white" for="password">
                                Password
                            </label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password">
                            <small id="error-username" class="error-text text-danger"></small>
                        </div>

                        <!-- Submit -->
                        <button class="btn w-100 btn-primary" type="submit">
                            Sign in
                        </button>

                    </form>

                    <!-- Text -->
                    <p class="mb-0 fs-sm text-body-secondary">
                        Don't have an account yet? <a href="signup-cover.html">Sign up</a>.
                    </p>

                </div>
                <div class="col-lg-7 offset-lg-1 align-self-stretch d-none d-lg-block">

                    <!-- Image -->
                    <div class="h-100 w-cover bg-cover"
                        style="background-image: url(assets/img/covers/cover-login.jpeg);"></div>

                    <!-- Shape -->
                    <div class="shape shape-start shape-fluid-y">
                        <svg viewBox="0 0 100 1544" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h100v386l-50 772v386H0V0z" fill="currentColor" />
                        </svg>
                    </div>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>

    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="./assets/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="./assets/js/theme.bundle.js"></script>


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    email: {
                        required: true,
                        minlength: 4,
                    },
                    password: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else { // jika error
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

</body>
</html>
