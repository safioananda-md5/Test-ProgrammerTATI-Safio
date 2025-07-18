<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>@stack('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/images/brand-2.png">
    <link rel="manifest" href="/assets/images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i%7CCovered+By+Your+Grace" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/hover-min.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/payonline-icon/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/bands-icon/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        
    </script>

    <style>
        .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 8px; /* Jarak antara label dan input */
            margin-bottom: 20px; 
        }

        .dataTables_filter label {
            margin: 0;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .dataTables_filter input {
            width: 200px;
            height: 30px;
            font-size: 0.875rem;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        /* Rapikan tombol paging (sekaligus) */
        .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.75rem;
            margin: 0 2px;
            font-size: 0.875rem;
            border-radius: 4px !important;
        }

        td.wrap-text {
            white-space: normal !important;
            word-break: break-word;
            vertical-align: top;
        }

        .role-name{
            color: #ffffff;
        }

        .role-name:hover{
            color: #001328;
        }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <div class="preloader"></div>
        <header class="site-header ">
            <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky header-style-two" style="background-color: rgba(255, 255, 255, 0.9)">
                <div class="container clearfix">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="logo-box clearfix">
                        <a class="navbar-brand" href="/dashboard">
                            <img src="/assets/images/brand.png" width="212" height="50" alt="Awesome Image"/>
                        </a>
                        <button class="menu-toggler" data-target="#main-nav-bar">
                            <span class="fa fa-bars"></span>
                        </button>
                    </div><!-- /.logo-box -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="main-navigation" id="main-nav-bar">
                        <ul class="navigation-box">
                            <li class="" id="dashboard_menu">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="" id="log_harian_menu">
                                <a href="#" class="blokir-link">Log Harian</a>
                                <span class="badge bg-danger text-light" id="notifBadgemain" style="display: none;">0</span>
                                <ul class="sub-menu">
                                    @if(in_array(Auth::user()->role->role_name, ['kepaladinas', 'kepalabagian', 'staff']))
                                        <li>
                                            <a href="/log-saya">Catat & Log Saya</a>
                                        </li>
                                    @endif
                                    @if(in_array(Auth::user()->role->role_name, ['admin', 'kepaladinas', 'kepalabagian']))
                                        <li>
                                            <a href="/{{ Auth::user()->role->role_name }}/log-manajemen">Kelola Log <span class="badge bg-danger text-light" id="notifBadgesecondary" style="display: none;">0</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            <li class="" id="profile_menu">
                                <a href="#" class="blokir-link">Profile</a>
                                <ul class="sub-menu">
                                    <li class="role-name">
                                        <div class="row">
                                            <div class="col-4 d-flex justify-content-center align-items-center"><img src="/assets/images/profile.png" alt="picture-profile" width="25" height="25"></div>
                                            <div class="col-8 d-flex justify-content-start">
                                                <a href="#"><span class="break-words text-sm leading-snug">{{ Auth::user()->name }}awfawfawfawfawf</span></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-4 d-flex justify-content-center align-items-center">{{ Auth::user()->role->role_name }}</span></div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="right-side-box">
                        <form action="/logout" method="post" id="logout">
                            @csrf
                            <a href="#" onclick="document.getElementById('logout').submit(); return false;" class="signin-btn">Logout</a>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        @yield('konten')

        <footer class="site-footer">
            <div class="upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 d-flex">
                            <div class="footer-widget my-auto">
                                <a href="index.html"><img src="/assets/images/brand-2.png" width="180" height="180" alt="Awesome Image"/></a>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 d-flex">
                            <div class="footer-widget links-widget my-auto links-widget-one">
                                <div class="title-box">
                                    <h3>Services</h3>
                                </div><!-- /.title-box -->
                                <ul class="link-lists">
                                    <li><a href="#">Time and Labor Management</a></li>
                                    <li><a href="#">HR Management</a></li>
                                </ul>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-3 -->
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 d-flex">
                            <div class="footer-widget links-widget my-auto">
                                <div class="title-box">
                                    <h3>Explore</h3>
                                </div><!-- /.title-box -->
                                <ul class="link-lists">
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Locations</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-2 -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center">
                            <div class="footer-widget my-auto">
                                <div class="social">
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </div><!-- /.social -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-5 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.upper-footer -->
            <div class="bottom-footer">
                <div class="container">
                    <p>&copy; Copyright 2025 by <a href="/" target="_blank">kepegawaian.com</a></p>
                </div><!-- /.container -->
            </div><!-- /.bottom-footer -->
        </footer>
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>

    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/isotope.js"></script>
    <script src="/assets/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/theme.js"></script>
    <script src="/datatables/js/jquery.dataTables.min.js"></script>

    @stack('scripts')

    @include('sweetalert::alert')

    <script>

        $(document).ready(function () {
            $('.blokir-link').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
            }).css({
                'pointer-events': 'none',   // Nonaktifkan klik sepenuhnya
                'cursor': 'default',        // Ubah cursor jadi biasa (bukan tangan)
                'opacity': '0.6'            // Opsional: kasih efek disabled
            });

            function loadNotifBadge() {
                $.ajax({
                    url: "{{ route('get.notifikasi') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 1) {
                            let jumlah = response.jumlah;

                            // Update badge
                            $('#notifBadgemain').text(jumlah);
                            $('#notifBadgesecondary').text(jumlah);

                            // Sembunyikan jika 0
                            if (jumlah === 0) {
                                $('#notifBadgemain').hide();
                                $('#notifBadgesecondary').hide();
                            } else {
                                $('#notifBadgemain').show();
                                $('#notifBadgesecondary').show();
                            }
                        }
                    }
                });
            }

            loadNotifBadge();
            setInterval(loadNotifBadge, 10000);

            let path = window.location.pathname;
            if(path == '/dashboard'){
                $('#dashboard_menu').addClass('current');
            }else if((path == '/log-saya') || (path == '/log-manajemen')){
                $('#log_harian_menu').addClass('current');
            }else{
                $('#profile_menu').addClass('current');
            }

        });
    </script>
</body>
</html>