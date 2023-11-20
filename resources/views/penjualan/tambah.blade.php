@extends('layouts.main')
@section('title', 'Transaksi')
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
        <td>Costumer</td>
        <td>
            <select name="pelanggan" class="form-control">
                @foreach ($pelanggan as $pelanggan)
                    <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                @endforeach
            </select>
        </td>
    </div>
    <div class="form-group">
        <td>Petugas</td>
        <td>
            <select name="petugas">
                @foreach ($users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->nama_user }}</option>
                @endforeach
            </select>
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
@section('content')