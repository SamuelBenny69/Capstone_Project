@extends('layouts.layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="padding: 2rem 0 2rem 0">
                <div class="col-md-4">
                    <div class="small-box bg-dark">
                        <div class="d-flex flex-wrap">
                            <div class="col-md-5 position-relative">
                                <img class="h-70 position-relative end-0 mt-5 ms-4 bg-primary rounded-lg"
                                    src="assets/img/icon/image.png" width="80px" alt="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h3>{{ $jumKaryawan }}</h3>
                                <p>Jumlah Karyawan</p>
                            </div>
                        </div>
                        <a href="/karyawan" class="small-box-footer">
                            More Info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-white">
                        <div class="d-flex flex-wrap">
                            <div class="col-md-5 position-relative">
                                <img class="h-70 position-relative end-0 mt-5 ms-4 bg-primary rounded-lg"
                                    src="assets/img/icon/image.png" width="80px" alt="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h3>{{ $karyawanPria }}</h3>
                                <p>Male</p>
                            </div>
                        </div>
                        <a href="/karyawan" class="small-box-footer">
                            More Info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-white">
                        <div class="d-flex flex-wrap">
                            <div class="col-md-5 position-relative">
                                <img class="h-70 position-relative end-0 mt-5 ms-4 bg-primary rounded-lg"
                                    src="assets/img/icon/image.png" width="80px" alt="">
                            </div>
                            <div class="col-md-6 mt-5">
                                <h3>{{ $karyawanWanita }}</h3>
                                <p>Female</p>
                            </div>
                        </div>
                        <a href="/karyawan" class="small-box-footer">
                            More Info
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 rounded-lg">
                    <div class="card-body bg-white">
                        <div class="col-md-11">
                            <canvas id="barChart" class="barChart" width="400" height="300"
                                data-labels='@json($labels)' data-male-data='@json($maleData)'
                                data-female-data='@json($femaleData)'>
                            </canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-white">
                        <div class="col-md-6 pt-5 ps-4 mb-2">
                            <h4>List Jabatan</h4>
                            <a href="/jabatan" class="btn-secondary btn-sm py-2 px-5">view</a>
                        </div>
                        <div class="overflow-scroll" style="max-height: 370px;"> <!-- Batasi tinggi dan aktifkan scroll -->
                            @foreach ($jabatanAll as $item)
                                <div class="row my-4 align-items-center">
                                    <div class="py-4 ms-7 col-2 bg-primary d-flex justify-content-center align-items-center rounded-3">
                                        <i class="nav-icon far fa-user"></i>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <h4>{{ $item->jabatan }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
