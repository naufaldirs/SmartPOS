<div class="container">
    <div class="row mt-6">
        <div class="col-md-12 ">
            <div class="alert alert-primary" role="alert">
            <h3>Hasil Peramalan untuk Sparepart: {{ $spareparts->nama_sparepart }}</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Actual /Pcs</th>
                        <th>Forecast /Pcs</th>
                        <th>MAD</th>
                        <th>MSE</th>
                        <th>MAPE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forecastResults as $result)
                    <tr>
                        <td>{{ $result->no }}</td>
                        <td>{{ date("F Y",strtotime($result->periode)) }}</td>
                        <td>{{ $result->actual }}</td>
                        <td>{{ $result->forecast }}</td>
                        <td>{{ $result->mad }}</td>
                        <td>{{ $result->mse }}</td>
                        <td>{{ number_format($result->mape * 100, 2) . '%' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-light m-auto" role="alert">
                <h4>Rata Rata Akurasi</h4>
                @php
                    $totalMad = 0;
                    $totalMse = 0;
                    $totalMape = 0;
                @endphp
    
                @foreach($forecastResults as $result)
                    @php
                        $totalMad += $result->mad;
                        $totalMse += $result->mse;
                        $totalMape += $result->mape;
                    @endphp
                @endforeach
    
                @php
                    $averageMad = count($forecastResults) > 0 ? $totalMad / count($forecastResults) : 0;
                    $averageMse = count($forecastResults) > 0 ? $totalMse / count($forecastResults) : 0;
                    $averageMape = count($forecastResults) > 0 ? $totalMape / count($forecastResults) : 0;
                @endphp
    
                <p>MAD: <span style="color: rgba(255, 206, 86, 1);">{{ round($averageMad,2) }}</span></p>
                <p>MSE: <span style="color: rgba(75, 192, 192, 1);">{{ round($averageMse, 2) }}</span></p>
                <p>MAPE: <span style="color: rgba(153, 102, 255, 1);">{{ number_format($averageMape  * 100, 2) . '%'  }}</span></p>
            </div>
            <h3 style="text-align: center
            ">Grafik Trend</h3>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
            <h3>Hasil Peramalan untuk Periode Selanjutnya</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Forecast</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nextForecast['no'] }}</td>
                        <td>{{ $nextForecast['periode'] }}</td>
                        <td>{{ $nextForecast['forecast'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
            <h3>Kesimpulan</h3>
            <p>Prediksi kebutuhan stok penjualan (sparepart: {{ $spareparts->nama_sparepart }}) pada bulan selanjutnya ({{ $nextForecast['periode'] }}) adalah {{ $nextForecast['forecast'] }} Pcs.</p>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/chart.js') }}"></script>
<script>
    // Data untuk grafik
    var data = {
        labels: [
            @foreach($forecastResults as $result)
                "{{ date('F Y', strtotime($result->periode)) }}",
            @endforeach
        ],
        datasets: [{
            label: "Actual",
            data: [
                @foreach($forecastResults as $result)
                    {{ $result->actual }},
                @endforeach
            ],
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 1
        },
        {
            label: "Forecast",
            data: [
                @foreach($forecastResults as $result)
                    {{ $result->forecast }},
                @endforeach
                {{ $nextForecast['forecast'] }}
            ],
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1
        }]
    };

    // Konfigurasi grafik
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Membuat grafik
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
    });
</script>