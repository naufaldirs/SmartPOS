@extends('layouts.main')
@section('title', 'Tambah Detail User')
@section('content')
<div class="container-sm tabel_background">
    <h2>Tambah Detail User</h2>

    <form action="{{ route('tambahdetail' , ['id_user' => $user->id_user]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table tableku">
            <tr>
                <div class="form-group">
                    <th><label for="nama">Nama</label></th>
                    <td><input type="text" class="form-control" name="nama" value="{{ $userDetail->nama ?? '' }}"></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <th><label for="tgllahir">Tanggal Lahir</label></th>
                    <td><input type="date" class="form-control" value="{{ $userDetail->tgl_lahir ?? '' }}" name="tgl_lahir"
                            id=""></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <th><label for="tempattinggal">Alamat</label></th>
                    <td><input type="text" class="form-control" value="{{ $userDetail->alamat ?? '' }}" name="alamat" id=""></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <th><label for="notelp">No Telp</label></th>
                    <td><input type="text" class="form-control" value="{{ $userDetail->no_telp ?? '' }}" name="no_telp"
                            id=""></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <th><label for="email">Email</label></th>
                    <td><input type="email" class="form-control" name="email" value="{{ $userDetail->email ?? '' }}" id=""></td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <th><label for="foto">Foto</label></th>
                    <td><input type="file" class="form-control" name="foto" id=""></td>
                </div>
            </tr>
        </table>
        <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
            <button type="submit" class="btn btn-primary ml-auto btn-lg active" role="button"
                aria-pressed="Simpan">Simpan</button>
        </div>
    </form>
</div>
@endsection