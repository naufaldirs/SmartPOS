    @extends('layouts.main')
    @section('title', 'Halaman Utama')
    @section('content')
    <h3>Data Diri Karyawan</h3>

        <!-- Konten Data Diri Karyawan -->
        <div class="karyawan-container">
          <div class="karyawan-foto">
            @if($userDetail->foto)
            <img src="{{ asset('storage/user_photos/' . $userDetail->foto) }}" alt="Foto User">
             @else
            <img src="{{ asset('img/mekanik.png') }}" alt="Foto Default">
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
                  <th scope="row">NIP</th>
                  <td>{{ session('nip','') }}</td>
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
          </div>
        </div>
        @endsection 