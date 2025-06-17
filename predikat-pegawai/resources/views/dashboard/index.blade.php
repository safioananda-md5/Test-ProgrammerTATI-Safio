<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/assets/img/illustrations/rocket-white.png">
    <title>
        Predikat Pegawai
    </title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/datatables/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

            .custom-height {
                height: 500px !important;
                text-align: start !important;
                overflow-y: auto;
            }
        </style>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
</head>
<body class="g-sidenav-show  bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
        <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="/assets/img/illustrations/rocket-white.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Predikat Pegawai</span>
        </a>
        </div>
        <hr class="horizontal dark mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active bg-gradient-dark text-white" href="/">
                <i class="material-symbols-rounded opacity-5">dashboard</i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
            </li>
        </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 d-flex justify-content-center mb-4">
            <a href="/"><b>predikatpegawai.com</b></a>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
            <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
            <p class="mb-4">
                Data dibawah bersifat dummy dan presentasi hanya tampilan.
            </p>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <p class="text-sm mb-0 text-capitalize">Sangat Baik</p>
                    <h4 class="mb-0">80</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10 text-success">person</i>
                    </div>
                </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>lebih baik</p>
                </div>
            </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <p class="text-sm mb-0 text-capitalize">Baik</p>
                    <h4 class="mb-0">70</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10 text-info">person</i>
                    </div>
                </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>lebih baik</p>
                </div>
            </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <p class="text-sm mb-0 text-capitalize">Butuh Perbaikan</p>
                    <h4 class="mb-0">22</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10 text-warning">person</i>
                    </div>
                </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>lebih baik</p>
                </div>
            </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <p class="text-sm mb-0 text-capitalize">Buruk</p>
                    <h4 class="mb-0">5</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10 text-primary">person</i>
                    </div>
                </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>lebih baik</p>
                </div>
            </div>
            </div>
            <div class="col-xl-2 col-sm-6">
            <div class="card">
                <div class="card-header p-2 ps-3">
                <div class="d-flex justify-content-between">
                    <div>
                    <p class="text-sm mb-0 text-capitalize">Sangat Buruk</p>
                    <h4 class="mb-0">2</h4>
                    </div>
                    <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                    <i class="material-symbols-rounded opacity-10 text-danger">Person</i>
                    </div>
                </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>lebih baik</p>
                </div>
            </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-11 col-md-9 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <h6>Data Pegawai</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive px-5">
                        <table class="table table-hover table-condensed table-sm" id="pegawai">
                            <thead>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Hasil Kerja</th>
                                <th>Perilaku</th>
                                <th>Kinerja</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <footer class="footer py-4  ">
            <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                    document.write(new Date().getFullYear())
                    </script>,
                    made with Heart by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">predikatpegawai.com</a>
                    for a better employee.
                </div>
                </div>
            </div>
            </div>
        </footer>
        </div>
    </main>

    <div class="modal fade" id="kinerja_pegawai" tabindex="-1" aria-labelledby="kinerja_pegawai_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/input_kinerja" method="post" id="input_kinerja">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="kinerja_pegawai_Label">Kinerja Pegawai</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="hidden_id" id="hidden_id">
                            <div class="mb-3">
                                <label for="input_hasil_kerja" class="col-form-label">Hasil Kerja Pegawai</label>
                                <select class="form-select form-select-sm" name="input_hasil_kerja">
                                    <option value="diatas">Diatas Ekspektasi</option>
                                    <option value="sesuai">Sesuai Ekspektasi</option>
                                    <option value="dibawah">Dibawah Ekspektasi</option>
                                </select>
                            </div>
                           <div>
                                <label for="input_perilaku" class="col-form-label">Perilaku Pegawai</label>
                                <select class="form-select form-select-sm" name="input_perilaku">
                                    <option value="diatas">Diatas Ekspektasi</option>
                                    <option value="sesuai">Sesuai Ekspektasi</option>
                                    <option value="dibawah">Dibawah Ekspektasi</option>
                                </select>
                           </div>
                           <span class="form-text text-danger error-text edit_log_harian_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/material-dashboard.min.js?v=3.2.0"></script>
    <script src="/datatables/js/jquery.dataTables.min.js"></script>

    <script>

        let table = $('table#pegawai').DataTable({
            processing:true,
            info:true,
            serverSide:true,
            responsive:true,
            scrollX: true,
            autoWidth:false,
            ajax:"{{route('get_pegawai')}}",
            columns:[
                { data:'nip', name:'nip', className: 'text-center', orderable: false },
                { data:'nama', name:'nama', orderable: false},
                { data:'hasil_kerja', name:'users.hasil_kerja', className: 'text-center', orderable: false},
                { data:'perilaku', name:'perilaku', className: 'wrap-text', orderable: false},
                { data:'kinerja', name:'kinerja', className: 'wrap-text', orderable: false},
                { data:'actions', name:'actions', className: 'text-center', orderable: false}
            ]
        });

        $(document).on('click', 'button#kinerja', function (e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: '/pegawai/show/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(view) {
                    $('#hidden_id').val(view.id);
                    $('#kinerja_pegawai').modal('show');
                },
                error: function() {
                    alert("Gagal mengambil data log.");
                }
            });
        });

        $('form#input_kinerja').on('submit', function(e){
            e.preventDefault();
            console.log('Form intercepted');
            let form = this;
            let formdata = new FormData(form);
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:formdata,
                processData:false,
                dataType:'json',
                contentType:false,
                success:function(data){
                    if(data.status == 1){
                        $(form)[0].reset();
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: data.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        $('#kinerja_pegawai').modal('hide');
                        table.ajax.reload(null,false); 
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                },
                error:function(xhr){
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: data.message,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).ready(function(){
            setInterval(function () {
                table.ajax.reload();
            }, 10000);
        });
    </script>
</body>
</html>