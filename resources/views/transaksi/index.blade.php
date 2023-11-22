@extends('layouts.main')
@section('title', 'Halaman Utama')
@section('content')
<div class="container-sm tabel_background">
    <div class="col-sm-7">
        <div class="d-flex form-inputs">
        </div>
    </div>
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
        <tr>
            <th>Barang : </th>
            <td>
                <select name="spareparts" id="spareparts" class="form-control" style="width:50%">
                    @foreach ($spareparts as $sparepart)
                        <option value="{{ $sparepart->kd_sparepart }}" id="spareparts" data-harga="{{ $sparepart->harga }}">{{ $sparepart->nama_sparepart }} - {{ $sparepart->harga }}</option>
                    @endforeach
                </select>
                <button onclick="return addRow()" class="btn btn-primary  btn-lg active" role="button" aria-pressed="Simpan">Save</button>            </td>
        </tr>
        </div>
    <form action="" method="POST">
        @method('put')


  <hr style="background-color: #936151;">
    <h4>NO NOTA : 11</h4>
    <!-- Place the table here -->
    <table id="barangTable" class="table table-hover table-striped-columns">
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
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
        <div class="form-group">
            <label for="total">Total</label>
            <input type="number" readonly  name="total">
          </div>
          <div class="ml-auto">

          </div>
          <div class="form-group">
            <label for="bayar">Bayar</label>
            <input type="number" name="bayar">
          </div>
          <div class="form-group">
            <label for="kembali">Kembali</label>
            <input type="number" readonly name="kembali">
          </div>
        </div>

    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
      <a href="#" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Batal</a>
      <a href="#" class="btn btn-primary ml-auto btn-lg active" role="button" aria-pressed="Simpan">Simpan</a>
      </div>
    </form>
</div>


@endsection
