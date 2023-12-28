@extends('layouts.main')
@section('title', 'Laporan Pajak')
@section('content')
<div class="tabel_background col-md-8">
    <div class="text-center">
      <h2 class="font-weight-bold">Laporan Pajak</h2>
    </div>
    <hr>
    <div class="text-center font-weight-bold" style="font-size: 20px; height: 20vh;">
      <p>Laporan Hasil Penjualan Pajak</p>
    </div>
    <section>
      <div class="form-group">
        <label for="year">Tahun Produksi:</label>
        <select id="year" class="form-control">
          <!-- Options for the year dropdown -->
          <option>-- Pilih Tahun --</option>
          @foreach ($salesData as $sale)
            <option value="{{ $sale->tahun }}">{{ $sale->tahun }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="harga">Total pendapatan:</label>
        <input type="text" id="harga" class="form-control" placeholder="Otomatis terisi setelah memilih tahun" readonly>
      </div>


      <div class="form-group">
        <label for="totalPPH">Total PPH yang harus dibayarkan:</label>
        <input type="text" id="totalPPH" class="form-control" placeholder="Otomatis terisi setelah menghitung" readonly>
      </div>
    </section>
  </div>

  <script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/laporan.js') }}"></script>

@endsection
