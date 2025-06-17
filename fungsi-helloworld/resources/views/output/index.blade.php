@extends('layouts.master')

@section('content')
<div class="container text-center" data-aos="zoom-out" data-aos-delay="100">
    <div class="row mb-5">
        <a class="btn btn-outline-light w-25" href="/" role="button">< Kembali</a>
    </div>
    <div class="row d-grid" style="grid-template-columns: repeat(10, 1fr); gap: 15px;">
        @for ($i = 1; $i <= $for_loop; $i++)
            <div class="col">
                <div class="kotak">
                    <div>{{ $i }}</div>
                    <div>
                        @if (($i % 4 == 0) && ($i % 5 == 0))
                            <span>helloworld</span>
                        @elseif ($i % 4 == 0)
                            <strong>hello</strong>
                        @elseif ($i % 5 == 0)
                            <strong>world</strong>
                        @endif
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection