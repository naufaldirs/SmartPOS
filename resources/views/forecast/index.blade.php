@extends('layouts.main')
@section('title', 'Peramalan')
@section('content')
<div class="container-sm tabel_background">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a class="first" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Istilah dan Penjelasan Forecasting
                        <span> </span>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>1. Alpha (α): Dalam konteks ini, alpha akan mempengaruhi seberapa cepat sistem merespons perubahan permintaan terhadap sparepart. Nilai alpha yang tinggi akan membuat model lebih responsif terhadap perubahan permintaan terbaru.</p>
                    <p>2. Actual (Aktual): Ini adalah jumlah sebenarnya dari permintaan sparepart selama suatu periode waktu tertentu, misalnya, jumlah sparepart yang benar-benar dibeli oleh pelanggan dalam sebulan.</p>
                    <p>3. Forecast (Perkiraan): Ini adalah prediksi jumlah stok yang dibutuhkan untuk memenuhi permintaan sparepart di masa mendatang. Model Exponential Smoothing akan menghasilkan perkiraan berdasarkan pola permintaan yang terdapat dalam data historis.</p>
                    <p>4. MAD (Mean Absolute Deviation): Rata-rata dari selisih absolut antara nilai aktual dan nilai perkiraan stok. Semakin rendah MAD, semakin kecil perbedaan antara stok yang sebenarnya dibutuhkan dan perkiraan yang dihasilkan oleh model.</p>
                    <p>5. MSE (Mean Squared Error): Ini adalah metrik evaluasi tambahan yang dapat digunakan dalam peramalan. MSE mengukur rata-rata dari kuadrat selisih antara nilai aktual dan nilai perkiraan. Semakin rendah nilai MSE, semakin baik model peramalan Anda. Nilai MSE yang rendah menunjukkan bahwa model dapat menghasilkan perkiraan yang sangat dekat dengan nilai aktual stok yang dibutuhkan.</p>
                    <p>6. MAPE (Mean Absolute Percentage Error): Rata-rata persentase kesalahan antara nilai aktual dan nilai perkiraan, tetapi kali ini diukur dalam persentase kesalahan stok yang dibutuhkan. Semakin rendah MAPE, semakin akurat model dalam memprediksi kebutuhan stok sparepart.</p>
                </div>
            </div>
        </div>

     
        </div>
    </div>
</div>
<div class="container-sm tabel_background">
<h4>Peramalan Stok Sparepart Menggunakan Metode Eksponential Smoothing</h4>
<form id="forecastForm">
    @csrf
    <label for="alpha">Alpha:</label>
    <select name="alpha" id="alpha" class="form-control">
        <option value="0.1">0.1</option>
        <option value="0.2" selected>0.2</option>
        <option value="0.3">0.3</option>
    </select>

    <label for="kd_sparepart">Sparepart:</label>
    <select name="kd_sparepart" id="kd_sparepart" class="form-control">
        @foreach($kdSpareparts as $sparepart)
            <option value="{{ $sparepart->kd_sparepart }}">{{ $sparepart->nama_sparepart }}</option>
        @endforeach
    </select>
    
    <div class="row p-12 pt-3 pb-3 d-flex align-items-center">
    <button type="button" onclick="hitungForecast()" class="btn btn-primary">Hitung</button>
    </div>
</form>

<!-- Tambahkan container untuk hasil peramalan -->
<div id="forecastResults"></div>

<script>
    function hitungForecast() {
        var alpha = document.getElementById('alpha').value;
        var kdSparepart = document.getElementById('kd_sparepart').value;

        // Kirim permintaan Ajax ke endpoint forecast
        $.ajax({
            type: 'POST',
            url: '/forecast',
            data: {
                _token: '{{ csrf_token() }}',
                alpha: alpha,
                kd_sparepart: kdSparepart
            },
            success: function (data) {
                // Tampilkan hasil peramalan dalam container
                $('#forecastResults').html(data);
            }
        });
    }
</script>

</div>
@endsection