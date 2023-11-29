var ctx = document.getElementById('penjualanChart').getContext('2d');

// Pastikan $penjualanData tidak bernilai null atau undefined
if ($penjualanData) {
    var penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $penjualanData->pluck('bulan') !!},
            datasets: [{
                label: 'Total Penjualan',
                data: {!! $penjualanData->pluck('total_penjualan') !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
}
