@extends('layouts.main')
@section('title', 'Ubah Barang')
@section('content')
<div class="row p-2 pt-3 d-flex align-items-right container">
</div>
<hr style="background-color: #936151;">
<form action="{{ route('ubahbarang', ['kd_sparepart' => $sparepart->kd_sparepart]) }}" method="POST">
  @csrf
  @if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
  @endif
  <table class="table tableku">
    <thead>
      <tr>
        <th>Kode</th>
      </tr>
      <tr>
        <td><input type="text" class="form-control" name="kd_sparepart" value="{{ $sparepart->kd_sparepart }}" placeholder="Kode"></td>
    </tr>
      <tr>
        <th>Produk</th>
        <th>Harga</th>     
       </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="text" class="form-control" name="nama_sparepart" value="{{ $sparepart->nama_sparepart }}" placeholder="Nama Barang"></td>
        <td> <input type="number" name="harga" value="{{ $sparepart->harga }}" class="form-control" id="" placeholder="Harga Satuan"></td>
    <input type="hidden" name="stok" value="{{ $sparepart->stok }}" id="stok" class="form-control" placeholder="Stok">
      </tr>
    </tbody>
  </table>
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
      <button class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</button>
    </div>
</form>
</div>
@endsection