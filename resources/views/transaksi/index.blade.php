@extends('layouts.main')
@section('title', 'Transaksi Kasir')
@section('content')
<div class="container-sm tabel_background">
    <form action="{{ route('transaksikasir') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
            @if(session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row">
            <!-- Transaction table (widest element) -->
            <div class="col-md-4">
              <!-- Product selection and user information -->
              <label for="spareparts">Barang:</label>
              <div class="d-flex form-inputs">
                  <select name="spareparts" id="spareparts" class="form-control" style="width:70%">
                      @foreach ($spareparts as $sparepart)
                          <option value="{{ $sparepart->kd_sparepart }}" id="spareparts" data-harga="{{ $sparepart->harga }}">{{ $sparepart->nama_sparepart }} - {{ $sparepart->harga }}</option>
                      @endforeach
                  </select>
                  <button onclick="addRow(event); return false;" class="btn btn-primary ml-2" role="button" aria-pressed="Simpan">
                    <i class="fa fa-save"></i> Save
                  </button>
              </div>
              <div class="form-group mt-3">
                <label for="pelanggan">Pelanggan:</label>
                <select name="pelanggan" id="pelanggan" class="form-control">
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
              <!-- User information -->
              <div class="form-group ">
                  <label for="no_nota">No Nota:</label>
                  <input type="text" name="no_nota" id="no_nota" class="form-control">
              </div>
              <div class="form-group">
                  <label for="tgl_nota">Tanggal Order:</label>
                  <input type="date" name="tgl_nota" id="tgl_nota" class="form-control">
              </div>

              <div class="form-group">
                  <label for="users">Petugas:</label>
                  <input type="hidden" class="form-control" name="user" value="{{ $users->id_user }}" readonly>
                  <p>{{ $users->nama }}</p>
              </div>
          </div>
            <div class="col-md-8">
                <table id="barangTable" class="table table-hover table-striped-columns">
                  <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
                    <tr style="color: #555555; ">
                        <th scope="col">NO</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col" style="max-width:15%;">Qty</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                    </thead>
                    <!-- Your table headers here -->
                    <tbody>
                        <!-- Existing rows can be added dynamically using JavaScript -->
                    </tbody>
                </table>
            </div>


        </div>

        <!-- Total, bayar, kembali, and pembayaran fields -->
        <div class="row p-12 pt-3 pb-3">
            <!-- Your total, bayar, kembali, and pembayaran fields here -->
            <div class="form-group">
              <label for="total">Total</label>
              <input type="text" id="total" readonly  name="total">
            </div>
            <div class="form-group">
              <label for="bayar">Bayar</label>
              <input type="text" id="bayar" name="bayar">
            </div>
            <div class="form-group">
              <label for="kembali">Kembali</label>
              <input type="text" readonly id="kembali" name="kembali">
            </div>
            <div class="form-group">
              <th><label for="pembayaran">Pembayaran</label></th>
              <select name="pembayaran" id="">
                  <option value="Cash">Cash</option>
                  <option value="E-Wallet">E-Wallet</option>
                  <option value="E-Wallet">Debit</option>
                  <option value="E-Wallet">Q-Ris</option>
              </select>
            </div>
        </div>

        <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
            <a href="#" onclick="history.back()" class="btn btn-danger btn-lg active" role="button">
                <i class="fa fa-minus-square"></i> Batal
            </a>
            <button class="btn btn-primary ml-auto btn-lg active" type="submit">
              <i class="fa fa-save"></i>Selanjutnya
            </button>
        </div>
    </form>
</div>
@endsection
