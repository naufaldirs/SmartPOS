@extends('layouts.main')
@section('title', 'Data Pelanggan')
@section('content')
<a href="{{ route('tambahpelangganview') }}" class="btn btn-lg active ml-auto p-3 " role="button" aria-pressed="true" style="background: #EBCDC3; border: 1px #CDCDCD solid; width: 20%; height: 100%;">Masukkan Pelanggan</a>
</div>
    <div class="container-sm tabel_background">
        <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
            <div class="col-md-5">
                <p>Daftar Pelanggan</p>
            </div>
            <div class="col-sm-7">
                <div class="d-flex form-inputs">
                    <input class="form-control ml-auto" type="text" placeholder="Cari" style="width: 70%;">
                    <i class="fal fa-search"></i>
                </div>
            </div>
        </div>
        <hr style="background-color: #936151;">
        <!-- Place the table here -->
        <table class="table table-hover table-striped-columns">
            <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
                <tr style="color: #555555; ">
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggans as $pelanggan)
                <tr>
                    <th scope="row">{{ $pelanggan->id_pelanggan }}</th>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                    <td>{{ $pelanggan->no_telp }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    <td>
                        <a href="{{ route('ubahpelangganview', ['id_pelanggan'=> $pelanggan->id_pelanggan]) }}"><i class="fa fa-pencil-square" style="font-size:24px;color:blue"></i></a> |
                        <a href="{{ route('hapuspelanggan', ['id_pelanggan' => $pelanggan->id_pelanggan]) }}" onclick="return konfirmasi()"><i class="fa fa-window-close" style="font-size:24px;color:red"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                @if ($pelanggans->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{ $pelanggans->url($pelanggans->currentPage() - 1) }}">&laquo;</a></li>
                @endif
        
                @for ($i = 1; $i <= $pelanggans->lastPage(); $i++)
                    <li class="page-item {{ ($pelanggans->currentPage() == $i) ? 'active' : '' }}"><a class="page-link" href="{{ $pelanggans->url($i) }}">{{ $i }}</a></li> 
                @endfor
        
                @if ($pelanggans->currentPage() < $pelanggans->lastPage())
                    <li class="page-item"><a class="page-link" href="{{ $pelanggans->url($pelanggans->currentPage() + 1) }}">&raquo;</a></li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
