@extends('layouts.master')

@push('title')
    Dashboard | kepegawaian.com
@endpush

@section('konten')
    <div id="minimal-bootstrap-carousel" class="carousel slide carousel-fade slider-content-style slider-home-one">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="carousel-item active slide-1" style="background-image: url(/assets/images/carousell-1.jpg);">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="box valign-middle">
                            <div class="content text-left">
                                <h3 data-animation="animated fadeInUp">Duty Check-in</h3>
                                <p data-animation="animated fadeInDown">Setiap pagi, karyawan diwajibkan melakukan <br> duty check-in melalui aplikasi absensi.</p>
                                <a data-animation="animated fadeInDown" href="#" class="thm-btn ">Submit Attendance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item slide-2" style="background-image: url(/assets/images/carousell-2.jpg);">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="box valign-middle">
                            <div class="content text-left">
                                <h3 data-animation="animated fadeInUp">Discipline <br> Monitoring</h3>
                                <p data-animation="animated fadeInDown">Pemantauan terhadap kedisiplinan karyawan <br> berdasarkan data kehadiran dan <br> kepatuhan terhadap jam kerja.</p>
                                <a data-animation="animated fadeInDown" href="#" class="thm-btn ">Submit Attendance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <a class="carousel-control-prev" href="#minimal-bootstrap-carousel" role="button" data-slide="prev">
            <i class="fa fa-arrow-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#minimal-bootstrap-carousel" role="button" data-slide="next">
            <i class="fa fa-arrow-right"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section class="service-style-one sec-pad-top">
        <div class="container text">
            <div class="sec-title text-center">
                <span>We make attendance smarter, for a better workplace</span>
                <h2>Integrated attendance and HR, <br> built for modern teams</h2>
            </div>
            <ul class="nav nav-tabs tab-title clearfix d-flex justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="#time" role="tab" data-toggle="tab">
                        <span class="icon-box">
                            <i class="payonline-icon-clock"></i>
                        </span>
                        <h3>Time & Attendance</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#benefits" role="tab" data-toggle="tab">
                        <span class="icon-box">
                            <i class="payonline-icon-checkmark-outlined-circular-button"></i>
                        </span>
                        <h3>Benefits</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#hr-management" role="tab" data-toggle="tab">
                        <span class="icon-box">
                            <i class="payonline-icon-settings"></i>
                        </span>
                        <h3>HR Management</h3>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="time">
                    <div class="single-tab-content">
                        <div class="icon-box">
                            <i class="payonline-icon-clock"></i>
                        </div>
                        <div class="text-box">
                            <h3>Time & Attendance</h3>
                            <p>Hemat waktu dan tingkatkan akurasi penggajian dengan sistem absensi karyawan yang fleksibel dan cerdas.</p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="benefits">
                    <div class="single-tab-content">
                        <div class="icon-box">
                            <i class="payonline-icon-checkmark-outlined-circular-button"></i>
                        </div>
                        <div class="text-box">
                            <h3>Benefits</h3>
                            <p>Transparansi data kehadiran, perencanaan kerja lebih akurat, dan keputusan SDM yang lebih tepat.</p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="hr-management">
                    <div class="single-tab-content">
                        <div class="icon-box">
                            <i class="payonline-icon-settings"></i>
                        </div>
                        <div class="text-box">
                            <h3>HR Management</h3>
                            <p>Permudah manajemen SDM dengan sistem absensi terintegrasi — otomatisasi pencatatan waktu, sederhanakan penggajian, dan ambil keputusan lebih cerdas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-one sec-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="cta-one-content">
                        <div class="sec-title">
                            <span>Find Your Solution</span>
                            <h2>Bicara langsung dengan HR untuk permasalahan Anda.</h2>
                        </div><!-- /.sec-title -->
                        <form action="#" class="cta-form">
                            {{-- input form --}}
                            <div class="btn-box">
                                <button type="submit" class="thm-btn">Kirim</button>
                                <div class="btn-tag-line"><i class="payonline-icon-share"></i>Kirimkan pertanyaan</div><!-- /.btn-tag-line -->
                            </div><!-- /.btn-box -->
                        </form><!-- /.cta-form -->
                    </div><!-- /.cta-one-content -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6 col-md-5 text-right">
                    <img src="/assets/images/mockup-1-2.png" alt="Awesome Image"/>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
@endsection