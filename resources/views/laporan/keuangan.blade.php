@extends('layouts.main')
@section('title', 'Laporan Keuangan')
@section('content')
<div class="container-sm tabel_background">
    <div class="row">
        <div class="col-md-5 d-flex align-items-center">
            <h2 class="mr-2">Laporan Keuangan</h2>
        </div>
        
    </div>
    <hr style="background-color: #936151;">
    <p>Hasil Penjualan</p>
      <!-- Filter by Date -->
      <div class="form-group">
        <label for="dateFilter">Pilih Rentang Waktu:</label>
        <select class="form-control" id="dateFilter">
            <option value="today">Hari Ini</option>
            <option value="this_week">Minggu Ini</option>
            <option value="this_month">Bulan Ini</option>
            <option value="this_year">Tahun Ini</option>
        </select>
    </div>

    <!-- Display Result -->
    <div class="result">
        <h4>Hasil:</h4>
        <p>Laba Kotor: <span id="labaKotor">0</span></p>
        <p>Laba Bersih: <span id="labaBersih">0</span></p>
        <p>Transaksi: <span id="transaksiCount">0</span></p>
        <p>Pendapatan Hari Ini: <span id="pendapatanHariIni">0</span></p>
    </div>
</div>
@endsection
