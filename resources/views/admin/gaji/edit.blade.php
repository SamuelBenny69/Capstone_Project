@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($gaji)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('gaji') }}" class="btn btn-sm btn-default mt2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/gaji/' . $gaji->id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">jabatan</label>
                        <div class="col-11">
                            <select class="form-control" id="id" name="jabatan_id" required>
                                <option value="">- Pilih jabatan -</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $gaji->jabatan_id) selected @endif>
                                        {{ $item->jabatan }}
                                    </option>
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
                                value="{{ old('gaji_pokok', $gaji->gaji_pokok) }}" required>
                            @error('gaji_pokok')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tunjangan Kehadiran</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="tunjangan_hadir" name="tunjangan_hadir"
                                value="{{ old('tunjangan_hadir', $gaji->tunjangan_hadir) }}" required>
                            @error('tunjangan_hadir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tunjangan Keluarga</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="tunjangan_keluarga" name="tunjangan_keluarga"
                                value="{{ old('tunjangan_keluarga', $gaji->tunjangan_keluarga) }}" required>
                            @error('tunjangan_keluarga')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Asuransi</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="asuransi" name="asuransi"
                                value="{{ old('asuransi', $gaji->asuransi) }}" required>
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
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
