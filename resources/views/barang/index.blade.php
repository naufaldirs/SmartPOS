@extends('layouts.main')
@section('title', 'Stok Barang')
@section('content')
<a href="{{ route('tambahbarangview') }}" class="btn btn-lg active ml-auto p-3 " role="button" aria-pressed="true" style="background: #EBCDC3; border: 1px #CDCDCD solid; width: 20%; height: 100%;">Masukkan Stok Masuk</a>
</div>
    <div class="container-sm tabel_background">
        <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
            <div class="col-md-5">
                <p>Daftar Sparepart</p>
            </div>
            <div class="col-sm-7">
                <div class="d-flex form-inputs">
                    <input class="form-control ml-auto" type="text" placeholder="Cari" style="width: 70%;">
                    <i class="fa fa-search"></i>
                </div>
            </div>
        </div>
        <hr style="background-color: #936151;">
        <!-- Place the table here -->
        <table class="table table-hover table-striped-columns">
            <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
            <tr style="color: #555555; ">
                <th scope="col" class="col-sm-2">Kode</th>
                <th scope="col">Produk</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
                @foreach($spareparts as $sparepart)
                <tr>
                    <th scope="row">{{ $sparepart->kd_sparepart }}</th>
                    <td>{{ $sparepart->nama_sparepart }}</td>
                    <td>{{ $sparepart->stok }}</td>
                    <td>{{ $sparepart->harga }}</td>
                    <td>
                        <a href="{{ route('ubahbarangview', ['kd_sparepart'=> $sparepart->kd_sparepart]) }}"><i class="fa fa-pencil-square" style="font-size:24px;color:blue"></i></a> |
                        <a href="{{ route('hapusbarang', ['kd_sparepart' => $sparepart->kd_sparepart]) }}" onclick="return konfirmasi()"><i class="fa fa-window-close" style="font-size:24px;color:red"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="paginate">
            <ul class="pagination justify-content-end">
                @if($spareparts->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $spareparts->previousPageUrl() }}">Previous</a>
                </li>
                @endif
    
                @for ($i = 1; $i <= $spareparts->lastPage(); $i++)
                <li class="page-item {{ ($spareparts->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $spareparts->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
    
                @if($spareparts->currentPage() < $spareparts->lastPage())
                <li class="page-item">
                    <a class="page-link" href="{{ $spareparts->nextPageUrl() }}">Next</a>
                </li>
                @endif
            </ul>
        </nav>
@endsection