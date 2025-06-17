@extends('layouts.master')

@push('title')
    Log Harian | kepegawaian.com
@endpush


@section('konten')
    <section class="meeting-form-wrapper sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-4">MANAJEMEN LOG HARIAN PEGAWAI</h3>
                    @if(in_array(Auth::user()->role->role_name, ['kepaladinas', 'kepalabagian', 'staff']))
                        <div class="text-danger d-flex align-items-center mb-4" role="alert">
                            <i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>
                            <div>
                                Anda hanya dapat menyetujui / menolak log pegawai yang berada 1 tingkat di bawah jalur koordinasi anda.
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed table-sm" id="log_pegawai">
                            <thead>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Log Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>

    let path = window.location.pathname;

    if(path == '/kepaladinas/log-manajemen'){
        let table = $('table#log_pegawai').DataTable({
            processing:true,
            info:true,
            serverSide:true,
            responsive:true,
            scrollX: true,
            autoWidth:false,
            ajax:"{{route('kepaladinas-get-log-pegawai')}}",
            columns:[
                { data:'nip', name:'nip', className: 'text-center', orderable: false },
                { data:'name', name:'users.name', orderable: false},
                { data:'position', name:'users.position', className: 'text-center', orderable: false},
                { data:'log_detail', name:'log_detail', className: 'wrap-text', orderable: false},
                { data:'created_at', name:'created_at', className: 'wrap-text', orderable: false},
                { data:'actions', name:'actions', className: 'text-center', orderable: false}
            ]
        });
        
        $(document).ready(function(){
            $(document).on('click', 'button#btn_setujui_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menyetujui log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('kepaladinas_setuju') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $(document).on('click', 'button#btn_tolak_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menolak log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#28a745',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('kepaladinas_tolak') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            setInterval(function () {
                table.ajax.reload();
            }, 10000);
        });
    }else if(path == '/kepalabagian/log-manajemen'){
        // window.location.href = '{{route('kepalabagian-get-log-pegawai')}}';
        let table = $('table#log_pegawai').DataTable({
            processing:true,
            info:true,
            serverSide:true,
            responsive:true,
            scrollX: true,
            autoWidth:false,
            ajax:"{{route('kepalabagian-get-log-pegawai')}}",
            columns:[
                { data:'nip', name:'nip', className: 'text-center', orderable: false },
                { data:'name', name:'users.name', orderable: false},
                { data:'position', name:'users.position', className: 'text-center', orderable: false},
                { data:'log_detail', name:'log_detail', className: 'wrap-text', orderable: false},
                { data:'created_at', name:'created_at', className: 'wrap-text', orderable: false},
                { data:'actions', name:'actions', className: 'text-center', orderable: false}
            ]
        });
        
        $(document).ready(function(){
            $(document).on('click', 'button#btn_setujui_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menyetujui log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('kepalabagian_setuju') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $(document).on('click', 'button#btn_tolak_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menolak log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#28a745',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('kepalabagian_tolak') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            setInterval(function () {
                table.ajax.reload();
            }, 10000);
        });
    }else if(path == '/admin/log-manajemen'){
        let table = $('table#log_pegawai').DataTable({
            processing:true,
            info:true,
            serverSide:true,
            responsive:true,
            scrollX: true,
            autoWidth:false,
            ajax:"{{route('admin-get-log-pegawai')}}",
            columns:[
                { data:'nip', name:'nip', className: 'text-center', orderable: false },
                { data:'name', name:'users.name', orderable: false},
                { data:'position', name:'users.position', className: 'text-center', orderable: false},
                { data:'log_detail', name:'log_detail', className: 'wrap-text', orderable: false},
                { data:'created_at', name:'created_at', className: 'wrap-text', orderable: false},
                { data:'actions', name:'actions', className: 'text-center', orderable: false}
            ]
        });
        
        $(document).ready(function(){
            $(document).on('click', 'button#btn_setujui_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menyetujui log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('admin_setuju') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $(document).on('click', 'button#btn_tolak_log', function(){
                let id = $(this).data('id');
                // alert(id);
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: 'Apakah anda yakin menolak log?',
                    html: 'Data yang sudah diinputkan tidak dapat dirubah.',
                    showCancelButton: true,
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#28a745',
                    width: 300,
                    allowOutsideClick: false,
                }).then(function(result){
                    if (result.isConfirmed) {
                        // Kirim data dengan POST setelah konfirmasi
                        $.ajax({
                            url: "{{ route('admin_tolak') }}", // Sesuaikan dengan route POST kamu
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    table.ajax.reload(null, false);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi kesalahan saat menyetujui log.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            setInterval(function () {
                table.ajax.reload();
            }, 10000);
        });
    }
    
    
</script>
@endpush