@extends('layouts.main')
@section('title', 'Transaksi Kasir')
@section('content')
<div class="container-sm tabel_background">
    <div class="col-sm-7">
        <div class="d-flex form-inputs">
        </div>
    </div>
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">

        </div>
 

        <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
            <tr>
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
            </tr>
       <!-- <tr>
            <th>Barang : </th>
            <td>
                    <select name="spareparts" id="spareparts" class="form-control" style="width:50%">
                    @foreach ($spareparts as $sparepart)
                        <option value="{{ $sparepart->kd_sparepart }}" id="spareparts" data-harga="{{ $sparepart->harga }}">{{ $sparepart->nama_sparepart }} - {{ $sparepart->harga }}</option>
                    @endforeach
                </select>
                
            </div>
        </tr>-->

        <form action="{{ route('transaksikasir') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="container-sm tabel_background">
    <div class="row">
        <div class="col-md-7">
            <!-- Form Group -->
            <div class="form-group">
                <label for="pelanggan">Pelanggan</label>
                <select name="pelanggan" id="pelanggan" class="form-control">
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                    @endforeach
                </select>
                <br>
            <div class="form-group">
                <label for="sparepart">Sparepart</label>
                <select name="sparepart" id="spareparts" class="form-control">
                    @foreach ($spareparts as $sparepart)
                    <option value="{{ $sparepart->kd_sparepart }}" id="spareparts" data-harga="{{ $sparepart->harga }}">{{ $sparepart->nama_sparepart }} - {{ $sparepart->harga }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="no_nota">No Nota</label>
                <input type="text" name="no_nota" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="tgl_nota">Tanggal Order</label>
                <input type="date" name="tgl_nota" id="tgl_nota" class="form-control">
            </div>

                <button onclick="addRow(event); return false;" class="btn btn-primary  btn-lg active" role="button" aria-pressed="Simpan"><i class="fa fa-check-circle-o" style="font-size:24px"></i> save</button></td>
            </div>

            <div class="form-group">
                <label for="users">Petugas</label>
                <input type="hidden" class="form-control" name="user" value="{{ $users->id_user  }}" readonly>
                <p>{{ $users->nama  }}</p>
            </div>

            <!-- Additional Form Inputs if needed -->

            <hr style="background-color: #936151;">
        </div>

        <div class="col-md-5">
            <!-- Place the table here -->
            <table id="barangTable" class="table table-hover table-striped-columns">
                <!-- Table Header -->
                <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
                    <tr style="color: #555555; ">
                        <th scope="col">NO</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Existing rows can be added dynamically using JavaScript -->
                </tbody>
            </table>
            <hr style="background-color: #936151;">

            <!-- Total, Bayar, Kembali, Pembayaran Form Inputs -->
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
                <label for="pembayaran">Pembayaran</label>
                <select name="pembayaran" id="">
                    <option value="Cash">Cash</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
        <a href="#" class="btn btn-danger btn-lg active" role="button">Batal</a>
        <button class="btn btn-primary ml-auto btn-lg active" type="submit">Simpan</button>
    </div>
</div>
</form>
</div>

@endsection