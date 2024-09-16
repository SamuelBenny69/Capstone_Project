@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($gaji_karyawan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $gaji_karyawan->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $gaji_karyawan->karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th>jabatan</th>
                        <td>{{ $gaji_karyawan->karyawan->jabatan->jabatan}}</td>
                    </tr>

                    <tr>
                        <th>Gaji Pokok</th>
                        <td>{{ $gaji_karyawan->gaji->gaji_pokok }}</td>
                    </tr>
                    <tr>
                        <th>Tunjangan Kehadiran</th>
                        <td>{{ $gaji_karyawan->gaji->tunjangan_hadir }}</td>
                    </tr>
                    <tr>
                        <th>Tunjangan Keluarga</th>
                        <td>{{ $gaji_karyawan->gaji->tunjangan_keluarga }}</td>
                    </tr>
                    <tr>
                        <th>Asuransi</th>
                        <td>{{ $gaji_karyawan->gaji->asuransi }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('gaji-karyawan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
