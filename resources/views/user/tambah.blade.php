@extends('layouts.main')
@section('title', 'Tambah User')
@section('content')
<div class="container-sm tabel_background">
    <h2>Tambah user</h2>


<form action="{{ route('tambahuser') }}" method="POST">
  @csrf
  <table class="table tableku">
    <tr>
      <div class="form-group">
          <th><label for="nip">NIP</label></th>
          <td><input type="text" class="form-control" name="nip" id="nip"></td>
      </div>
  </tr>
  <tr>
  <div class="form-group">
    <th><label for="password">Password</label></th>
    <td><input type="text" class="form-control" name="password" id="password"></td>
</div>
</tr>
<tr>
    <div class="form-group">
      <th><label for="jabatan">Jabatan</label></th>
      <td> 
        <input type="radio" id="admin" name="role" value="admin">
        <label for="admin">Admin</label><br>
        <input type="radio" id="kasir" name="role" value="kasir">
        <label for="kasir">Kasir</label><br>
        <input type="radio" id="akuntan"  name="role" value="akuntan">
        <label for="akuntan">Akuntan</label> <br>
        <input type="radio" id="manajer" name="role" value="manajer">
        <label for="manajer">Manajer</label>
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