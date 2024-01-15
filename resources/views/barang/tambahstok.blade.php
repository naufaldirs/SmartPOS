@extends('layouts.main')
@section('title', 'Tambah Stok')
@section('content')
<div class="container-fluid">
<div class="row p-2 pt-3 d-flex align-items-right">
</div>
<hr style="background-color: #936151;">
<form action="{{ route('tambahstok', ['kd_sparepart' => $sparepart->kd_sparepart]) }}" method="POST">
    @method('PUT')
  @csrf
  @if($errors->has('error'))
  <div class="alert alert-danger">
      {{ $errors->first('error') }}
  </div>
@endif
  <div class="form-group">
    <input type="hidden" class="form-control" name="kd_sparepart" value="{{ $sparepart->kd_sparepart }}" placeholder="Kode">
    <label for="nama_sparepart">Produk</label>
    <input type="text" class="form-control" name="nama_sparepart" value="{{ $sparepart->nama_sparepart }}" readonly placeholder="Nama Barang">
    <input type="hidden" name="harga" value="{{ $sparepart->harga }}" class="form-control" id="" placeholder="Harga Satuan">
  </div>
  <div class="form-group">
    <label for="stokbaru">Tambah</label>
    <input type="hidden" name="stoklama" value="{{ $sparepart->stok }}" id="stok"  placeholder="Stok">
    <input type="number" name="stokbaru" class="form-control">
  </div>
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
      <button class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</button>
    </div>
</form>
</div>
</div>
@endsection