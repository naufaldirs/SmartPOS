function calculateNextForecast(alpha, prevForecast, forecastArray) {
    // Mendapatkan bulan selanjutnya
    var nextMonth = new Date();
    nextMonth.setMonth(prevForecast['periode'].getMonth() + 1);

    // Contoh sederhana
    var nextForecastValue = alpha * prevForecast['forecast'] + (1 - alpha) * prevForecast['forecast'];

    // Menghitung Mean Absolute Deviation (MAD)
    var mad = Math.abs(prevForecast['forecast'] - forecastArray[forecastArray.length - 1]['actual']);

    // Menghitung Mean Squared Error (MSE)
    var mse = Math.pow(prevForecast['forecast'] - forecastArray[forecastArray.length - 1]['actual'], 2);

    // Menghitung Mean Absolute Percentage Error (MAPE)
    var mape = prevForecast['forecast'] !== 0 ?
      Math.abs((prevForecast['forecast'] - forecastArray[forecastArray.length - 1]['actual']) / prevForecast['forecast']) * 100 : 0;

    // Memperbarui elemen HTML
    document.getElementById('nextForecastNo').innerText = prevForecast['no'] + 1;
    document.getElementById('nextForecastPeriode').innerText = nextMonth.toISOString().split('T')[0];
    document.getElementById('nextForecastForecast').innerText = nextForecastValue.toFixed(2);
    document.getElementById('nextForecastMad').innerText = mad.toFixed(2);
    document.getElementById('nextForecastMse').innerText = mse.toFixed(2);
    document.getElementById('nextForecastMape').innerText = mape.toFixed(2);
  }