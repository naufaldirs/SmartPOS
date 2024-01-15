@extends('layouts.main')
@section('title', 'History Pembayaran')
@section('content')
<div class="container-sm tabel_background">
    <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
        <div class="col-md-5">
            <p>History Pembayaran</p>
        </div>
        <div class="col-sm-7">
            <div class="d-flex form-inputs">
                <input class="form-control ml-auto" id="myInput" type="text" placeholder="Cari" style="width: 70%;">
                <span class="input-group-text bg-white border-0"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <hr style="background-color: #936151;">
    <!-- Place the table here -->
    <table class="table table-hover table-striped-columns">
        <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
        <tr style="color: #555555; ">
            <th scope="col">Nama</th>
            <th scope="col">No Telp</th>
            <th scope="col">Email</th>
            <th scope="col">Tanggal Order</th>
        </tr>
        </thead>
        <tbody id="myTable">
            @foreach($historyPayments as $payment)
            <tr>
                <td>{{ $payment->nama_pelanggan }}</td>
                <td>{{ $payment->no_telp }}</td>
                <td>{{ $payment->email }}</td>
                <td>{{ $payment->tgl_nota }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            {{-- Previous Page --}}
            <li class="page-item {{ $historyPayments->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $historyPayments->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
    
            {{-- Numbered Pages --}}
            @php
                $startPage = max(1, $historyPayments->currentPage() - 2);
                $endPage = min($historyPayments->lastPage(), $startPage + 4);
            @endphp
    
            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="page-item {{ $historyPayments->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ route('historypembayaran', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor
    
            {{-- Next Page --}}
            <li class="page-item {{ $historyPayments->currentPage() == $historyPayments->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $historyPayments->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    
    
    
    
@endsection