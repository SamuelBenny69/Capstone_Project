@extends('layouts.layout')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('jabatan/create') }}">Filter</a>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('jabatan/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-striped table-hover table-sm" id="table_jabatan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jabatan Kode</th>
                        <th>jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var datajabatan = $('#table_jabatan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('jabatan/list') }}",
                    "dataType": "json",
                    "type": "POST"
                },
                columns: [{
                    data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kode_jabatan",
                    className: "",
                    orderable: true,
                    searchable: true 
                }, {
                    data: "jabatan",
                    className: "",
                    orderable: true,
                    searchable: true 
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false 
                }]
            });
        });
    </script>
@endpush
