<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Fungsi Helloworld!</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://static.vecteezy.com/system/resources/previews/002/362/995/large_2x/hello-world-icon-free-vector.jpg" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .kotak {
            color: white;
            border: 1px solid #ffffff;
            border-radius: 5px;
            text-align: center;
            padding: 10px;
            width: 100px;
            height: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>
<body class="index-page">
    <header id="header" class="header d-flex align-items-center dark-background sticky-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
            <nav id="navmenu" class="navmenu">
                <ul>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <div class="header-social-links">
            </div>
        </div>
    </header>
    <main class="main">
        <section id="hero" class="hero section">
            <img src="/assets/img/night.png" alt="" data-aos="fade-in">
            @yield('content')
        </section>
    </main>
    <footer id="footer" class="footer dark-background">
        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">fungsihelloworld.com</strong> <span>All Rights Reserved<br></span></p>
            </div>
            <div class="credits">
                Designed by <a href="#">fungsihelloworld.com</a> Distributed by <a href="#">Evergreen
            </div>
        </div>
    </footer>
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/js/main.js"></script>

    @stack('script')
</body>
</html>