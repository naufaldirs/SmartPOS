@extends('layouts.main')
@section('title', 'Tambah Pelanggan')
@section('content')
<div class="container-sm tabel_background">
<form action="{{ route('tambahpelanggan') }}" method="POST">
  @csrf
  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table tableku">
    <tr>
      <div class="form-group">
          <th><label for="nama_pelanggan">Nama Pelanggan</label></th>
          <td><input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan"></td>
      </div>
  </tr>
  <tr>
  <div class="form-group">
    <th><label for="no_telp">No Telp</label></th>
    <td><input type="text" class="form-control" name="no_telp" id="no_telp"></td>
</div>
</tr>
<tr>
    <div class="form-group">
        <th><label for="email">Email</label></th>
        <td><input type="text" class="form-control" name="email" id="email"></td>
    </div> 
     </td>
    </td>
  </div>
  </tr>
  </table>
  <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
    <button class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</button>
    </div>
</form>
</div>
@endsection