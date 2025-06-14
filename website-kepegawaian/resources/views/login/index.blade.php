<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Sign In || kepegawaian.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/images/kepegawaian-icon.jpg">
    <link rel="manifest" href="/assets/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i%7CCovered+By+Your+Grace" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/payonline-icon/style.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <style>
        input.no-arrow::-webkit-inner-spin-button,
        input.no-arrow::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input.no-arrow {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="preloader"></div>
        <section class="signin-wrapper min-vh-100 clearfix" style="background-image: url(/assets/images/login-img.jpg);">
            <div class="form-block min-vh-100">
                <h1 class="text-center mb-4">LOGIN</h1>
                <form action="/login" method="post">
                    @csrf
                    <input type="number" class="form-control no-arrow @error('signin-nip') is-invalid @enderror" name="signin-nip" placeholder="Masukkan NIP" value="{{ old('signin-nip') }}" autofocus>
                    @error('signin-nip')
                        <div class="invalid-feedback">
                            {{ "Nama wajib diisi!" }}
                        </div>
                    @enderror
                    <input type="password" class="form-control @error('signin-password') is-invalid @enderror" name="signin-password" placeholder="Password" autofocus>
                    @error('signin-password')
                        <div class="invalid-feedback">
                            {{ "Password wajib diisi!" }}
                        </div>
                    @enderror
                    <a href="#" class="forgot-password">Forgot password?</a>
                    <button type="submit" class="thm-btn">Sign In</button>
                </form>
                <p class="copy-text">© Copyright 2025 by <a href="login">kepegawaian.com</a></p>
            </div>
            <div class="background-block min-vh-100" style="background-image: url(/assets/images/login-img.jpg);"></div><!-- /.background-block -->
        </section>
    </div>
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/isotope.js"></script>
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/jquery.bxslider.min.js"></script>
    <script src="/assets/js/theme.js"></script>

    @include('sweetalert::alert')
</body>
</html>