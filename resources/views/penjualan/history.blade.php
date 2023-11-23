@extends('layouts.main')
@section('title', 'Detail User')
@section('content')
<div class="container-sm tabel_background">
    <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
        <div class="col-md-5">
            <p>Riwayat Penjualan</p>
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
            <th scope="col">Nama</th>
            <th scope="col">No Telp</th>
            <th scope="col">Email</th>
            <th scope="col">Tanggal Order</th>
        </tr>
        </thead>
        <tbody>
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
            @for ($i = 1; $i <= ceil(count($historyPayments) / $historyPayments->perPage()); $i++)
                <li class="page-item {{ $historyPayments->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ url('/user/history-payments?page=' . $i) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </nav>
    
@endsection