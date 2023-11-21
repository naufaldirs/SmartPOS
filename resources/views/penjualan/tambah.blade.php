@extends('layouts.main')
@section('title', 'Transaksi')
@section('content')
<div class="container-sm tabel_background">
    <h2>Tambah Penjualan</h2>
<form action="{{ route('tambahpelanggan') }}" method="POST">
    @csrf
      <table class="table tableku">
        <tr>
          <div class="form-group">
              <th><label for="no_nota">No Nota</label></th>
              <td><input type="text" class="form-control" name="no_nota" id="no_nota"></td>
          </div>
      </tr>
      <tr>
      <div class="form-group">
        <th><label for="tgl_nota">Tanggal Order</label></th>
        <td><input type="text" class="form-control" name="tgl_nota" id="tgl_nota"></td>
    </div>
    </tr>
    <tr>
        <div class="form-group">
          <th><label for="pelanggan">Jabatan</label></th>
            <td>
                <select name="pelanggan" id="pelanggan" class="form-control">
                    @foreach ($pelanggan as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                    @endforeach
                </select>
        </td>
      </div>
      </tr>
      <tr>
        <div class="form-group">
          <th><label for="user">Jabatan</label></th>
                <div class="form-group">
                        <select name="user" id="user">
                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}">{{ $user->nama_user }}</option>
                            @endforeach
                        </select>
                    </td>
                </div>
      </div>
      </tr>
      </table>
      <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
        <button class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</button>
        </div>
    </form>
    </div>


