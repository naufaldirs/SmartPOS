@extends('layouts.main')
@section('title', 'Detail User')
@section('content')
<h6>Data Diri Karyawan</h6>

<!-- Konten Data Diri Karyawan -->
<div class="karyawan-container container-fluid">
  <div class="karyawan-foto">
    @if($userDetail->foto)
    <img src="{{ asset('storage/user_photos/' . $userDetail->foto) }}" alt="Foto User">
@else
    <img src="{{ asset('img/mekanik.jpg') }}" alt="Foto Default">
@endif

  </div>

  <div class="karyawan-tabel">
    <!-- Tempatkan tabel data diri di sini -->
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">Nama</th>
          <td>{{ $userDetail->nama }}</td>
        </tr>
        <tr>
          <th scope="row">Tanggal Lahir</th>
          <td>{{ $userDetail->tgl_lahir }}</td>
        </tr>
        <tr>
          <th scope="row">Alamat</th>
          <td>{{  $userDetail->alamat  }}</td>
        </tr>
        <tr>
          <th scope="row">No. Telp</th>
          <td>{{  $userDetail->no_telp  }}</td>
        </tr>
        <tr>
          <th scope="row">Email</th>
          <td>{{ $userDetail->email }}</td>
        </tr>
      </tbody>
    </table>
    <div class="p-12 pt-3 pb-3 mt-6 d-flex align-items-center">
      <a href="{{ route('manajemenuser') }}" class="btn btn-secondary  btn-lg active" role="button" aria-pressed="true">Kembali</a>
      </div>
  </div>
</div>
@endsection 