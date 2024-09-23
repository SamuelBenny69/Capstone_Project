@extends('layouts.layout')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('gaji/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-md" id="table_gaji">
                        <thead class="justify-content-center align-items-center">
                            <h4 class="fw-bold text-center">Cetak Laporan</h4>
                            <tr>
                                <th>Cetak Laporan Absen</th>
                                <th><a class="btn btn-primary" href="laporan/cetakLaporanAbsen">Cetak</a></th>
                            </tr>
                            <tr>
                                <th>Cetak Laporan Gaji</th>
                                <th><a class="btn btn-primary" href="laporan/cetakLaporanGaji">Cetak</a></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
