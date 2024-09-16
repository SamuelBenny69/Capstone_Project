@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('gaji-karyawan/' . $gaji_karyawan->id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tanggal Gajian</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="tgl_gaji" name="tgl_gaji"
                            value="{{ old('tgl_gaji', $gaji_karyawan->tgl_gaji) }}" required>
                        @error('tgl_gaji')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Karyawan</label>
                    <div class="col-10">
                        <select class="form-control" id="karyawan_id" name="karyawan_id" required>
                            <option value="">- Pilih Karyawan -</option>
                            @foreach ($karyawan as $item)
                                <option value="{{ $item->id }}" data-jabatan="{{ $item->jabatan->jabatan }}"
                                    {{ $item->id == $gaji_karyawan->karyawan_id ? 'selected' : '' }}>
                                    {{ $item->nama }} - {{ $item->jabatan->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('karyawan_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Field for automatically displaying jabatan based on selected karyawan -->
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Jabatan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" readonly
                            value="{{ $gaji_karyawan->karyawan->jabatan->jabatan }}">
                    </div>
                </div>

                <!-- Field to show salary details dynamically based on jabatan -->
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Gaji Pokok</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" readonly
                            value="{{ old('gaji_pokok', $gaji_karyawan->gaji->gaji_pokok) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tunjangan Kehadiran</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="tunjangan_hadir" name="tunjangan_hadir" readonly
                            value="{{ old('tunjangan_hadir', $gaji_karyawan->gaji->tunjangan_hadir) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Tunjangan Keluarga</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="tunjangan_keluarga" name="tunjangan_keluarga"
                            readonly value="{{ old('tunjangan_keluarga', $gaji_karyawan->gaji->tunjangan_keluarga) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 control-label col-form-label">Asuransi</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="asuransi" name="asuransi" readonly
                            value="{{ old('asuransi', $gaji_karyawan->gaji->asuransi) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 control-label col-form-label"></label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('gaji-karyawan') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Set initial jabatan and salary fields when the page loads
        var initialKaryawanId = $('#karyawan_id').val();
        if (initialKaryawanId) {
            loadGaji(initialKaryawanId);
        }

        $('#karyawan_id').on('change', function() {
            var karyawanId = $(this).val();
            if (karyawanId) {
                loadGaji(karyawanId);
            }
        });

        function loadGaji(karyawanId) {
            var jabatan = $('#karyawan_id').find('option:selected').data('jabatan');
            $('#jabatan').val(jabatan);

            $.ajax({
                "url": "{{ url('gaji-karyawan/get-gaji') }}/" + karyawanId,
                "type": 'GET',
                "success": function(data) {
                    if (!data.error) {
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

                        $('#gaji_pokok').val(formatRupiah(data.gaji_pokok));
                        $('#tunjangan_hadir').val(formatRupiah(data.tunjangan_hadir));
                        $('#tunjangan_keluarga').val(formatRupiah(data.tunjangan_keluarga));
                        $('#asuransi').val(formatRupiah(data.asuransi));
                    } else {
                        alert(data.error);
                    }
                }
            });
        }
    });
</script>
@endpush
