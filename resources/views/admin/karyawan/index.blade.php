@extends('layouts.layout')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('karyawan/create') }}">Tambah</a>
            </div>
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
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_karyawan">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jabatan</th>
                                <th>Nama</th>
                                <th>Jkel</th>
                                <th>Status</th>
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
            var dataKaryawan = $('#table_karyawan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('karyawan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.jabatan_id = $('#jabatan_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "jabatan.jabatan",
                        className: "",
                        orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                        data: "nama",
                        className: "",
                        orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                        searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                    }, {
                        data: "jkel",
                        className: "",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "status",
                        className: "",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }

                ]
            });


            $('#jabatan_id').on('change', function() {
                dataKaryawan.ajax.reload();
            });

        });
    </script>
@endpush
