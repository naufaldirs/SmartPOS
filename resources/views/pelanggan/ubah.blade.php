@extends('layouts.main')
@section('title', 'Ubah Pelanggan')
@section('content')
<div class="container-sm tabel_background">


<form action="{{ route('ubahpelanggan', ['id_pelanggan' => $pelanggan->id_pelanggan]) }}" method="POST">
  @csrf
  <table class="table tableku">
    <tr>
      <div class="form-group">
          <th><label for="nama_pelanggan">Nama Pelanggan</label></th>
          <td><input type="text" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" name="nama_pelanggan" id="nama_pelanggan"></td>
      </div>
  </tr>
  <tr>
  <div class="form-group">
    <th><label for="no_telp">No Telp</label></th>
    <td><input type="text" class="form-control" value="{{ $pelanggan->no_telp }}" name="no_telp" id="no_telp"></td>
</div>
</tr>
<tr>
    <div class="form-group">
        <th><label for="email">Email</label></th>
        <td><input type="email" class="form-control" value="{{ $pelanggan->email }}" name="email" id="email"></td>
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