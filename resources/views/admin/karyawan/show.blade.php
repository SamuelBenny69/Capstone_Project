@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($karyawan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $karyawan->id }}</td>
                    </tr>
                    <tr>
                        <th>jabatan</th>
                        <td>{{ $karyawan->jabatan->jabatan }}</td>
                    </tr>

                    <tr>
                        <th>name</th>
                        <td>{{ $karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th>jkel</th>
                        <td>{{ $karyawan->jkel }}</td>
                    </tr>
                    <tr>
                        <th>status</th>
                        <td>{{ $karyawan->status }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('karyawan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
