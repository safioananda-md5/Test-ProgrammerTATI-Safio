@extends('layouts.master')

@push('title')
    Log Harian | kepegawaian.com
@endpush

@section('konten')
    <section class="meeting-form-wrapper sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="log_harian_terisi" style="display: none">
                        <div class="alert alert-success">
                            Anda sudah mengisi log harian hari ini. Terima kasih!
                        </div>
                    </div>
                    <form action="/input-log-saya" method="post" class="meeting-form" id="store_log_form">
                        @csrf
                        <h3 class="mb-4">INPUT LOG HARIAN SAYA</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="#date-log">Tanggal</label>
                                <input type="text" name="date_log" value="{{ $tanggalFormat }}" id="date_log" readonly>
                            </div>
                            <div class="col-md-12">                            
                                <label for="#nip">NIP Pegawai</label>
                                <input type="number" name="nip" value="{{ Auth::user()->nip }}" id="nip" readonly>
                            </div>
                            <div class="col-md-12">                            
                                <label for="#name">Nama Pegawai</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" id="name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="#log_harian">Log Harian</label>                       
                                <textarea name="log_harian" class="form-control @error('log_harian') is-invalid @enderror" id="log_harian" placeholder="Masukkan kegiatan yang dikerjakan"></textarea>
                                <span class="form-text text-danger error-text log_harian_error"></span>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-box">
                                    <button type="submit" class="thm-btn">Kirim Log</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5" id="riwayat-log-saya">
                <div class="col-lg-12">
                    <div class="meeting-form">
                        <h3 class="mb-4">RIWAYAT LOG SAYA</h3>
                        <table class="table table-bordered table-hover" id="daftar_log_saya">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Log</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="edit_log" tabindex="-1" aria-labelledby="edit_log_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/update-log-saya" method="post" id="update_log_form">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit_log_Label">Edit Log</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="mb-3">
                            <tbody>
                                <tr>
                                    <td>ID Log</td>
                                    <td style="width: 20px;" class="text-center">:</td>
                                    <td id="id_log_edit"></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td style="width: 20px;" class="text-center">:</td>
                                    <td id="nip_edit"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td style="width: 20px;" class="text-center">:</td>
                                    <td id="tanggal_edit"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <input type="hidden" name="hidden_id_log_edit" id="hidden_id_log_edit">
                            <label for="edit_log_harian" class="col-form-label">Log Harian:</label>
                            <textarea class="form-control" name="edit_log_harian" id="edit_log_harian"></textarea>
                            <span class="form-text text-danger error-text edit_log_harian_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>

    let table = $('table#daftar_log_saya').DataTable({
        processing:true,
        info:true,
        serverSide:true,
        responsive:true,
        scrollX: true,
        autoWidth:false,
        pageLength:7,
        aLengthMenu:[[7,14,21,30,-1],[7,14,21,30,'All']],
        ajax:"{{route('get-log-saya')}}",
        columns:[
            { data:'id', name:'id', className: 'text-center', orderable: false },
            { data:'log_detail', name:'log_detail', orderable: false},
            { data:'updated_at', name:'updated_at', className: 'text-center', orderable: false},
            { data:'log_status', name:'log_status', className: 'text-center wrap-text', orderable: false},
            { data:'actions', name:'actions', className: 'text-center', orderable: false}
        ]
    });

    $(document).ready(function () {
        let hasLogToday = @json($hasLogToday);

        if(hasLogToday) {
            $('#store_log_form').remove();
            $('#log_harian_terisi').show();
            $('#riwayat-log-saya').removeClass('mt-5');
        }

        function renumberLines() {
            const lines = $('#log_harian').val().split('\n');
            const newLines = lines.map((line, index) => {
                const cleanLine = line.replace(/^\d+\.\s*/, '');
                return `${index + 1}. ${cleanLine}`;
            });
            $('#log_harian').val(newLines.join('\n'));
        }

        $('#log_harian').on('focus', function () {
            if ($(this).val().trim() === '') {
                $(this).val('1. ');
            }
        });

        $('#log_harian').on('input', renumberLines);

        $('form').on('submit', function () {
            let textarea = $('#log_harian');
            let lines = textarea.val().split('\n');

            let cleaned = [];
            let count = 1;

            lines.forEach(function (line) {
                if (!line.match(/^\d+\.\s*$/)) {
                    cleaned.push((count++) + '. ' + line.replace(/^\d+\.\s*/, '')); // hapus nomor lama lalu tambahkan nomor baru
                }
            });

            textarea.val(cleaned.join('\n'));
        });

        $('form#store_log_form').on('submit', function(e){
            e.preventDefault();

            let form = this;
            let formdata = new FormData(form);

            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:formdata,
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 1){
                        $(form)[0].reset();
                        $('#store_log_form').remove();
                        $('#log_harian_terisi').show();
                        $('#riwayat-log-saya').removeClass('mt-5');
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: data.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        table.ajax.reload(null,false)
                    }
                },
                error:function(data){
                    if(data.status == 0){
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: data.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                    $.each(data.responseJSON.errors, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            });
        });
    });

    $(document).on('click', '#tombolModal', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: '/log-harian/show/' + id,
            method: 'GET',
            dataType: 'json',
            success: function(view) {
                let nipSaya = "{{ Auth::user()->nip }}";

                if(view.nip !== nipSaya){
                    Swal.fire({
                        icon: 'error',
                        title: 'Akses Ditolak',
                        text: 'Anda tidak memiliki izin untuk mengakses log ini.',
                    });
                    return;
                }
                
                $('#id_log_edit').html(view.id);
                $('#nip_edit').html(view.nip);

                let tanggal = new Date(view.updated_at);
                let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                let tanggalFormat = tanggal.toLocaleDateString('id-ID', options);

                $('#tanggal_edit').html(tanggalFormat);
                $('#edit_log_harian').val(view.log_detail);
                $('#hidden_id_log_edit').val(view.id);
                $('#edit_log').modal('show');
            },
            error: function() {
                alert("Gagal mengambil data log.");
            }
        });
    });

    function renumberLinesedit() {
        const lines = $('#edit_log_harian').val().split('\n');
        const newLines = lines.map((line, index) => {
            const cleanLine = line.replace(/^\d+\.\s*/, '');
            return `${index + 1}. ${cleanLine}`;
        });
        $('#edit_log_harian').val(newLines.join('\n'));
    }

    $('#edit_log_harian').on('focus', function () {
        if ($(this).val().trim() === '') {
            $(this).val('1. ');
        }
    });

    $('#edit_log_harian').on('input', renumberLinesedit);

    $('form').on('submit', function () {
        let textarea = $('#edit_log_harian');
        let lines = textarea.val().split('\n');

        let cleaned = [];
        let count = 1;

        lines.forEach(function (line) {
            if (!line.match(/^\d+\.\s*$/)) {
                cleaned.push((count++) + '. ' + line.replace(/^\d+\.\s*/, '')); // hapus nomor lama lalu tambahkan nomor baru
            }
        });

        textarea.val(cleaned.join('\n'));
    });

    $('form#update_log_form').on('submit', function(e){
        e.preventDefault();
        let form = this;
        let formdata = new FormData(form);
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:formdata,
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(form).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 1){
                    $(form)[0].reset();
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: response.message,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    $('#edit_log').modal('hide');
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
@endpush