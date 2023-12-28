@extends('layouts.main')
@section('title', 'Grafik Penjualan')
@section('content')
<div class="container-sm tabel_background"> 
    <div class="row p-2 pt-3 pb-3 d-flex align-items-center">
                <div class="card">
                    <div class="card-header">Grafik Penjualan</div>
                    <div class="card-body">
                        <canvas id="penjualanChart" width="1280" height="768"></canvas>
                    </div>
                </div>
        </div>
        </div>
</div>
<script src="{{ asset('js/chart.js') }}"></script>  
<script>
    var ctx = document.getElementById('penjualanChart').getContext('2d');
    var penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $penjualanData->pluck('bulan') !!},
            datasets: [{
                label: 'Total Penjualan',
                data: {!! $penjualanData->pluck('total_penjualan') !!},
                backgroundColor: 'rgba(255, 0, 19, 0.7)',
                borderColor: 'rgba(241, 0, 15, 0.8)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection