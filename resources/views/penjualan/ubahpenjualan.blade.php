@extends('layouts.main')
@section('title', 'Ubah Penjualan')
@section('content')
<div class="container-sm tabel_background">
    <h2>Ubah Penjualan</h2>
<form action="{{ route('ubahpenjualan', ['no_nota' => $penjualan->no_nota]) }}" method="POST">
    @csrf
    @method('PUT')
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
      <table class="table tableku">
        <tr>
          <div class="form-group">
              <th><label for="no_nota">No Nota</label></th>
              <td><input type="text" class="form-control" value="{{ $penjualan->no_nota }}" name="no_nota" id="no_nota"></td>
          </div>
      </tr>
    <tr>
      <tr>
        <div class="form-group">
            <th><label for="tgl_nota">Tanggal Order</label></th>
            <td><input type="date" class="form-control" name="tgl_nota" id="tgl_nota"></td>
        </div>
    </tr>
  <tr>
        <div class="form-group">
          <th><label for="pelanggan">Pelanggan</label></th>
            <td>
                <select name="pelanggan" id="pelanggan" class="form-control">
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                    @endforeach
                </select>
        </td>
      </div>
      </tr>
      <tr>
        <div class="form-group">
          <th><label for="users">Petugas</label></th>
            <td><input type="text" class="form-control" name="users" {{ $users->nama }}" value="{{ $users->nama  }}" readonly></td>
      </div>
      </tr>
      </table>
      <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
        <button class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</button>
        </div>
    </form>
    </div>
@endsection

