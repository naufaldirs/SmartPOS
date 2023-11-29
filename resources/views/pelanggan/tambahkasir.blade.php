@extends('layouts.main')
@section('title', 'Tambah Pelanggan')
@section('content')
<div class="container-sm tabel_background">
<form action="{{ route('tambahpelanggankasir') }}" method="POST">
  @csrf
  <tr>
    @if(session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
</tr>
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