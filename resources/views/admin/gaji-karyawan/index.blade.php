@extends('layouts.layout')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('gaji-karyawan/create') }}">Tambah</a>
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
                    <table class="table table-striped table-hover table-sm" id="table_gaji_karyawan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Gajian</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Gaji Pokok</th>
                                <th>Tunjangan Kehadiran</th>
                                <th>Tunjangan Keluarga</th>
                                <th>Asuransi</th>
                                <th>Total Gaji</th>
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
        function formatRupiah(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp ' + rupiah;
        }

        $(document).ready(function() {
            var dataGaji = $('#table_gaji_karyawan').DataTable({
                serverSide: true, // serverSide: true, jika ingin menggunakan server side processing
                ajax: {
                    "url": "{{ url('gaji-karyawan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.karyawan_id = $('#karyawan_id').val();
                        d.gaji_id = $('#gaji_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // nomor urut dari laravel datatable addIndexColumn()
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "tgl_gaji",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "karyawan.nama",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "karyawan.jabatan.jabatan",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "gaji.gaji_pokok",
                        className: "text-center",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            return formatRupiah(data)
                        }
                    }, {
                        data: "gaji.tunjangan_hadir",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data)
                        }
                    }, {
                        data: "gaji.tunjangan_keluarga",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data)
                        }
                    }, {
                        data: "gaji.asuransi",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return formatRupiah(data)
                        }
                    }, {
                        data: "",
                        className: "text-center",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            // Hitung total gaji
                            var totalGaji = parseInt(row.gaji.gaji_pokok) +
                                parseInt(row.gaji.tunjangan_hadir) +
                                parseInt(row.gaji.tunjangan_keluarga) +
                                parseInt(row.gaji.asuransi);

                            return formatRupiah(totalGaji);

                        }
                    }, {
                        data: "aksi",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }

                ]
            });


            $('#karyawan_id', '#gaji_id').on('change', function() {
                dataGaji.ajax.reload();
            });

        });
    </script>
@endpush
