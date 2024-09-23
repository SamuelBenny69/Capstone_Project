@extends('layouts.layout')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_absen">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Karyawan</th>
                                <th>Jabatan</th>
                                <th>Tanggal Absen</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var dataAbsen = $('#table_absen').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('absen/list') }}",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}",
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jabatan",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "tgl_absen",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "ket",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
