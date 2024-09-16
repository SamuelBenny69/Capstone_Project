@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('gaji') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">jabatan</label>
                    <div class="col-11">
                        <select class="form-control" id="id" name="jabatan_id" required>
                            <option value="">- Pilih jabatan -</option>
                            @foreach ($jabatan as $item)
                                <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                            @endforeach
                        </select>
                        @error('jabatan_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Gaji Pokok</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok"
                            value="{{ old('gaji_pokok') }}" required>
                        @error('gaji_pokok')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tunjangan Kehadiran</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="tunjangan_hadir" name="tunjangan_hadir" value="{{ old('tunjangan_hadir') }}"
                            required>
                        @error('tunjangan_hadir')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Tunjangan Keluarga</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="tunjangan_keluarga" name="tunjangan_keluarga" required>
                        @error('tunjangan_keluarga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Asuransi</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="asuransi" name="asuransi" required>
                        @error('asuransi')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('gaji') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
