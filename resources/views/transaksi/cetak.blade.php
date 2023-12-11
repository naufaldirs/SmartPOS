<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/bootstrap4.min.css') }}">
</head>
<body>
    <style>

        h3 {
            font-size: 24px;
            font-style: italic;
            font-weight: bold;
        }
    
        .header,
        .info,
        .oke {
            justify-content: space-between;
            margin-bottom: 30px;
            margin-top: 20px;
        }
    
        .header p,
        .info p,
        .total p {
            margin: 0;
        }
    
        .logo {
            width: 70%;
        }
    
        .table {
            width: 100%;
        }
    
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    
        .powered-by {
            font-size: 12px;
        }
    </style>
    <div class="header">
        <div class=" d-flex align-items-center">
            
          <h1>BENGKEL SMART</h1>
    
            </div>
            <p>Invoice No : {{ $penjualan->no_nota }}</p>
            <p>Invoice Date : {{ $penjualan->tgl_nota }}</p><br>
            <p>Invoice To :</p>
            <p>{{ $penjualan->pelanggan->nama_pelanggan }}</p> 
            <p>{{ $penjualan->pelanggan->no_telp }}</p> 
            <p>{{ $penjualan->pelanggan->email }}</p>
            <p></p>
      </div>
    
      <div>
    
      </div>
    
      <!-- Place the table here -->
      <table class="table table-hover table-striped-columns">
          <thead style="background: #FFE4DB; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 15px">
              <tr style="color: #555555; ">
                  <th scope="col">NO</th>
                  <th scope="col">Produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Subtotal</th>
              </tr>
          </thead>
          <tbody>
            @foreach($penjualan->penjualanDetails as $index => $detail)          <tr>
                <th scope="row">{{ intval($index) + 1 }}</th>
                <td>
                  {{ $detail->sparepart->nama_sparepart }}
                </td>
                <td>{{ $detail->sparepart->harga }}</td>
                <td>{{ $detail->qty }}</td>
                <td>{{ $detail->subtotal }}</td>
            </tr>
        @endforeach
        
          </tbody>
          <tr>
            <td colspan="4" align="right"><b>Total Harga:</b></td>
            <td>{{ $penjualan->total }}</td>
        </tr>
        <tr>
            <td colspan="4" align="right"><b>Bayar:</b></td>
            <td>{{ $penjualan->bayar }}</td>
        </tr>
        <tr>
            <td colspan="4" align="right"><b>Kembali:</b></td>
            <td>{{ $penjualan->kembali }}</td>
        </tr>
      </table>
      <div class="footer">
          <p>Terima kasih atas kunjungan anda di bengkel SMARTT</p>

          <img src="{{ public_path('img/logo.png') }}" alt="Logo" class="logo ml-auto">

      </div>
    </div>
</body>
</html>