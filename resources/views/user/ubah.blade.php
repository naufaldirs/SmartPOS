@extends('layouts.main')
@section('title', 'Ubah User')
@section('content')
<div class="container-sm tabel_background">
    <h2>Ubah user</h2>


<form action="{{ route('updateuser', ['id_user' => $user->id_user]) }}" method="POST">
  @csrf
  @method('PUT')
  <table class="table tableku">
    <tr>
      <div class="form-group">
          <th><label for="nip">NIP</label></th>
          <td><input type="text" class="form-control" name="nip" value="{{ $user->nip }}" id="nip"></td>
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
            <input type="radio" id="admin" name="role" value="admin" {{ ($user->role == 'admin') ? 'checked' : '' }}>
            <label for="admin">Admin</label><br>
    
            <input type="radio" id="kasir" name="role" value="kasir" {{ ($user->role == 'kasir') ? 'checked' : '' }}>
            <label for="kasir">Kasir</label><br>
    
            <input type="radio" id="akuntan"  name="role" value="akuntan" {{ ($user->role == 'akuntan') ? 'checked' : '' }}>
            <label for="akuntan">Akuntan</label><br>
    
            <input type="radio" id="manajer" name="role" value="manajer" {{ ($user->role == 'manajer') ? 'checked' : '' }}>
            <label for="manajer">Manajer</label>
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