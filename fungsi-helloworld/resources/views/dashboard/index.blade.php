@extends('layouts.master')

@section('content')
<div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2>Fungsi Hellowolrd!</h2>
            <p class="text-sm">Selamat datang di simulasi HelloWorld 2.0 <br> — awal dari petualangan digitalmu dimulai di sini! —</p>
            <form action="{{ route('function-begin') }}" method="post">
                @csrf
                <div class="input-group mt-5">
                    <input type="number" name="number_input" class="form-control" placeholder="Masukkan angka" aria-label="Recipient’s username" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="submit" id="button-addon2">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        document.getElementById('number_input').addEventListener('input', function () {
            if (this.value < 0) this.value = 0;
        });
    </script>
@endpush