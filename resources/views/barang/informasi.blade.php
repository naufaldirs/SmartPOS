@extends('layouts.main')
@section('title', 'Informasi Barang')
@section('content')
<div class="container-sm tabel_background">
    <div class="row">
        <div class="col-md-5 d-flex align-items-center">
            <p class="mr-2">Informasi Barang</p>
        </div>
        <div class="col-md-5 text-right ml-sm-auto">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Cari">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: #936151;">

    <!-- Place the table here -->
    <table class="table table-hover table-striped-columns">
        <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
            <tr style="color: #555555; ">
                <th scope="col">Kode</th>
                <th scope="col">Produk</th>
                <th scope="col">Sisa Stok</th>
                <th scope="col">Terjual</th>
                <th scope="col">Stok Alert</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spareparts as $sparepart)
            <tr>
                <th scope="row">{{ $sparepart->kd_sparepart }}</th>
                <td>{{ $sparepart->nama_sparepart }}</td>
                <td>{{ $sparepart->stok }}</td>
                <td>{{ $terjual[$sparepart->kd_sparepart] ?? 0 }}</td>
                <td>@if($sparepart->stok < 10)
                   <span style="color: red">Sedikit</span>
                @else
                    <span style="color: rgb(9, 237, 9)">Banyak</span>
                @endif         
             </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Manual Pagination Links -->
    <nav aria-label="Page navigation example">
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
</div>
@endsection
