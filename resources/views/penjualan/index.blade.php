@extends('layouts.main')
@section('title', 'Transaksi')
@section('content')
<a href="{{ route('tambahpenjualan') }}" class="btn btn-lg active ml-auto p-3" role="button" aria-pressed="true"
        style="background: #EBCDC3; border: 1px #CDCDCD solid;  color: white;">Tambah User</a>
    <div class="container-sm tabel_background">
        <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
            <div class="col-md-5">
                <p>Daftar User</p>
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
                    <th>No. Nota</th>
                    <th>Tanggal Order</th>
                    <th>Keterangan</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Pelanggan</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualanData as $data)
                <tr>
                    <td>{{ $data->no_nota }}</td>
                    <td>{{ $data->tgl_nota }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>{{ $data->pembayaran }}</td>
                    <td>{{ $data->total }}</td>
                    <td>{{ $data->bayar }}</td>
                    <td>{{ $data->kembali }}</td>
                    <td>{{ $data->pelanggan->nama_pelanggan }}</td>
                    <td>{{ $data->user->nip }}</td>
                        <td>
                            <a href="{{ route('ubahpenjualan', $data->no_nota) }}">Edit</a> |
                            <a href="{{ route('hapuspenjualan', $data->no_nota) }}" onclick="return konfirmasi()">Delete</a> | 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            @if ($currentPage > 1)
                <li class="page-item"><a class="page-link" href="{{ route('indexpenjualan', ['page' => $currentPage - 1]) }}">&laquo;</a></li>
            @endif
        
            @for ($i = 1; $i <= $total_pages; $i++)
                <li class="page-item {{ ($currentPage == $i) ? 'active' : '' }}"><a class="page-link" href="{{ route('indexpenjualan', ['page' => $i]) }}">{{ $i }}</a></li> 
            @endfor
        
            @if ($currentPage < $total_pages)
                <li class="page-item"><a class="page-link" href="{{ route('indexpenjualan', ['page' => $currentPage + 1]) }}">&raquo;</a></li>
            @endif
            </ul>
        </nav>
    </div>
@endsection