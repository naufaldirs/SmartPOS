@extends('layouts.main')
@section('title', 'Tambah Pelanggan')
@section('content')
<div class="container-sm tabel_background">
  <div class="text-center">
    <h2 class="mb-4">Input Pelanggan</h2>
  </div>
  
  <form action="{{ route('tambahpelanggankasir') }}" method="POST">
    @csrf
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
  @endif
    <div class="form-group row">
      <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
      </div>
    </div>

    <div class="form-group row">
      <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="no_telp" id="no_telp">
      </div>
    </div>

    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="email" id="email">
      </div>
    </div>

    <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
      <button class="btn btn-primary ml-auto btn-lg" role="button" aria-pressed="Simpan">Simpan</button>
    </div>
  </form>
</div>
@endsection
