<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Models\ForecastResult;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class PeramalanController extends Controller
{
    //
    public function index() {
        $kdSpareparts = Sparepart::all();
        return view('forecast.index', compact('kdSpareparts'));
    }
    private function calculateNextForecast($alpha, $prevForecast, $forecast)
    {
        // Mendapatkan bulan selanjutnya
        $nextMonth = date('Y-m', strtotime('+1 month', strtotime($prevForecast['periode'])));
        
        // Contoh sederhana
        $nextForecastValue = $alpha * $prevForecast['forecast'] + (1 - $alpha) * $prevForecast['forecast'];
    
        // Menghitung Mean Absolute Deviation (MAD)
        $mad = abs($prevForecast - $forecast);
    
        // Menghitung Mean Squared Error (MSE)
        $mse = pow($prevForecast - $forecast, 2);
    
        // Menghitung Mean Absolute Percentage Error (MAPE)
        $mape = $prevForecast != 0 ? abs(($prevForecast - $forecast) / $prevForecast) * 100 : 0;
    
    
        return [
            'periode' => $nextMonth, // Menggunakan bulan selanjutnya
            'forecast' => round($nextForecastValue, 2),
            'mad' => $mad,
            'mse' => $mse,
            'mape' => $mape,
        ];
    }
    
    public function saveForecastResults($forecast)
    {
        DB::table('forecast_results')->truncate(); // Hapus data sebelumnya
        // Assuming you have a ForecastResult model
        DB::table('forecast_results')->insert($forecast);
    
        // You can add additional logic or error handling here
    
        return response()->json(['message' => 'Forecast result for the next period saved successfully']);
    }
    
    
    public function forecast(Request $request)
    {


        try {

            $alpha = $request->input('alpha', 0.2);
            if ($alpha <= 0 || $alpha >= 1) {
                // Tangani nilai alpha di luar rentang yang valid
                return response()->json(['error' => 'Invalid alpha value'], 400);
            }
            $kdSparepart = $request->input('kd_sparepart');
    
            
            $forecast = [];
            $errors = [];
            $prevForecast = 0; // Nilai awal diatur ke 0 karena akan diakumulasi

// Proses perhitungan single exponential smoothing
$penjualan = DB::table('penjualan_detail')
    ->join('penjualan', 'penjualan_detail.no_nota', '=', 'penjualan.no_nota')
    ->where('penjualan_detail.kd_sparepart', $kdSparepart)
    ->orderBy('penjualan.tgl_nota') // Corrected ordering clause
    ->select('penjualan_detail.qty', 'penjualan.tgl_nota')
    ->get();

foreach ($penjualan as $index => $data) {
    // Menggunakan join dengan tabel Penjualan untuk mendapatkan tgl_nota
    $currentForecast = $alpha * $prevForecast + (1 - $alpha) * $prevForecast;

    $forecast[] = [
        'no' => $index + 1,
        'kd_sparepart' => $kdSparepart,
        'periode' => $data->tgl_nota,
        'actual' => $prevForecast, // Menggunakan jumlah qty untuk tgl_nota yang sama
        'forecast' => round($currentForecast, 2),
        'mad' => abs($prevForecast - $currentForecast),
        'mse' => pow($prevForecast - $currentForecast, 2),
        'mape' => $prevForecast != 0 ? abs(($prevForecast - $currentForecast) / $prevForecast) * 100 : 0,
    ];

    $prevForecast += $data->qty; // Menambahkan qty pada tgl_nota yang sama
}

// Hitung nilai MAD, MSE, MAPE
$mad = array_sum(array_column($forecast, 'mad')) / count($forecast);
$mse = array_sum(array_column($forecast, 'mse')) / count($forecast);
$mape = array_sum(array_column($forecast, 'mape')) / count($forecast);



        // Hitung peramalan untuk periode selanjutnya
        // $nextForecast = $this->calculateNextForecast($alpha, $prevForecast, $forecast);

        // Menggabungkan hasil peramalan sekarang dan untuk periode selanjutnya
        $this->saveForecastResults($forecast);                    
                    // Hitung kesimpulan prediksi
            // Ambil data peramalan dari database
            $forecastResults = DB::table('forecast_results')->get();
               // Hitung peramalan untuk periode selanjutnya
            //    $prevForecast = end($forecast);
            //    $nextForecast = $this->calculateNextForecast($alpha, $prevForecast,$forecast);
            // Kirim response dalam bentuk HTML
    
            // Kirim response dalam bentuk HTML
            return view('forecast.result', compact('forecastResults', 'kdSparepart'));
        } catch (\Exception $e) {
            // Tampilkan pesan kesalahan
            return response()->json(['error' => 'Error in calculation: ' . $e->getMessage()], 500);        }
    }

}
