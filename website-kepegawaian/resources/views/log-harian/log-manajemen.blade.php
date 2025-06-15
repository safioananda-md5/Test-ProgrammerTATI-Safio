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
                        <h3 class="mb-4">MANAJEMEN LOG HARIAN PEGAWAI</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="#date-log">Tanggal</label>
                                <input type="date" name="date-log" value="{{ now() }}" id="date-log" readonly>
                            </div>
                            
                        </div>
                    </form>
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