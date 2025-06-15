@extends('layouts.master')

@push('title')
    Log Harian | kepegawaian.com
@endpush


@section('konten')
    <section class="meeting-form-wrapper sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="/log-harian" method="post" class="meeting-form">
                        @csrf
                        <h3 class="mb-4">INPUT LOG HARIAN</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="#date-log">Tanggal</label>
                                <input type="date" name="date-log" value="{{ now() }}" id="date-log" readonly>
                            </div>
                            <div class="col-md-12">                            
                                <label for="#nip">NIP Pegawai</label>
                                <input type="text" name="nip" value="1311414" id="nip" readonly>
                            </div>
                            <div class="col-md-12">                            
                                <label for="#name">Nama Pegawai</label>
                                <input type="text" name="name" value="saya sendiri" id="name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="#log-harian">Log Harian</label>                       
                                <textarea name="log-harian" id="log-harian" placeholder="Masukkan kegiatan yang dikerjakan"></textarea>
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
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="meeting-form">
                        <h3 class="mb-4">RIWAYAT LOG</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function renumberLines() {
        const lines = $('#log-harian').val().split('\n');
        const newLines = lines.map((line, index) => {
            const cleanLine = line.replace(/^\d+\.\s*/, '');
            return `${index + 1}. ${cleanLine}`;
        });
        $('#log-harian').val(newLines.join('\n'));
    }

    $(document).ready(function () {
        $('#log-harian').on('focus', function () {
            if ($(this).val().trim() === '') {
                $(this).val('1. ');
            }
        });

        $('#log-harian').on('input', renumberLines);
    });
</script>
@endpush