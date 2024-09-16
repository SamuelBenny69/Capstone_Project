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
                <a href="{{ url('karyawan') }}" class="btn btn-sm btn-default mt2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/karyawan/' . $karyawan->id) }}" class="form-horizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">jabatan</label>
                        <div class="col-11">
                            <select class="form-control" id="id" name="jabatan_id" required>
                                <option value="">- Pilih jabatan -</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $karyawan->jabatan_id) selected @endif>
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
                        <label class="col-1 control-label col-form-label">nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $karyawan->nama) }}" required>
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">jkel</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="jkel" name="jkel"
                                value="{{ old('jkel', $karyawan->jkel) }}" required>
                            @error('jkel')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">status</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="status" name="status"
                                value="{{ old('status', $karyawan->status) }}" required>
                            @error('status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('karyawan') }}">Kembali</a>
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
