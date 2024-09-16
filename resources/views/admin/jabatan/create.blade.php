@extends('layouts.layout')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('jabatan') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">jabatan Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan"
                            value="{{ old('kode_jabatan') }}" required>
                        @error('kode_jabatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">jabatan</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}"
                            required>
                        @error('jabatan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('jabatan') }}">Kembali</a>
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
