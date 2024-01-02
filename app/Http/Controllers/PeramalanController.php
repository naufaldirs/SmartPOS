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

    
    
public function forecast(Request $request)
{
    try {
        $alpha = $request->input('alpha', 0.2);
        $alpha = floatval($alpha);
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
            ->orderBy('penjualan.tgl_nota')
            ->select(DB::raw('SUM(penjualan_detail.qty) as qty'), DB::raw('DATE_FORMAT(penjualan.tgl_nota, "%Y-%m-%d") as periode'))
            ->groupBy('periode')
            ->get();

        foreach ($penjualan as $index => $data) {
            // Menggunakan join dengan tabel Penjualan untuk mendapatkan tgl_nota
            if (isset($data->qty)) {
                $currentForecast = $alpha * $data->qty + (1 - $alpha) * $prevForecast;
                $forecast[] = [
                    'no' => $index + 1,
                    'kd_sparepart' => $kdSparepart,
                    'periode' => $data->periode . '-01', // Tambahkan '-01' untuk menyesuaikan format datetime
                    'actual' => $data->qty, // Menggunakan jumlah qty untuk tgl_nota yang sama
                    'forecast' => round($currentForecast),
                    'mad' => round(abs($data->qty - $currentForecast), 3),
                    'mse' => round(pow($data->qty - $currentForecast, 2), 3),
                    'mape' => $data->qty != 0 ? round(abs(($data->qty - $currentForecast) / $data->qty) * 100, 2) : 0,
                ];
                $prevForecast = $currentForecast; // Menyimpan nilai peramalan sebelumnya
            } else {
                $currentForecast = 0; // Nilai default
                $forecast[] = [
                    'no' => $index + 1,
                    'kd_sparepart' => $kdSparepart,
                    'periode' => $data->periode,
                    'actual' => 0, // Nilai default
                    'forecast' => round($currentForecast, 2),
                    'mad' => 0, // Nilai default
                    'mse' => 0, // Nilai default
                    'mape' => 0, // Nilai default
                ];
            }
        }

        // Hitung peramalan untuk periode selanjutnya
        $lastData = end($forecast);
        $nextForecast = $this->calculateNextForecast($alpha, $lastData, $prevForecast, $kdSparepart);
        // Menggabungkan hasil peramalan sekarang dan untuk periode selanjutnya
        $this->saveForecastResults($forecast);

        // Ambil data peramalan dari database
        $forecastResults = DB::table('forecast_results')->get();
        $spareparts = Sparepart::find($kdSparepart);
        // Kirim response dalam bentuk HTML
        return view('forecast.result', compact('forecastResults', 'spareparts', 'nextForecast'));
    } catch (\Exception $e) {
        // Tampilkan pesan kesalahan
        return response()->json(['error' => 'Error in calculation: ' . $e->getMessage()], 500);
    }
}
private function calculateNextForecast($alpha, $lastData, $prevForecast, $kdSparepart)
{
$nextForecast = $alpha * $lastData['actual'] + (1 - $alpha) * $prevForecast;
$mad = 0;
$mse = 0;
$mape = 0;
$count = 0;

if (!is_array($prevForecast) && !is_object($prevForecast)) {
    $mad = 0;
    $mse = 0;
    $mape = 0;
} else {
    // variabel $prevForecast adalah sebuah array atau objek
    // lanjutkan dengan perulangan foreach
    foreach ($prevForecast as $forecast) {
        if (isset($forecast['mad'])) {
            $mad += $forecast['mad'];
            $count++;
        }
        if (isset($forecast['mse'])) {
            $mse += $forecast['mse'];
        }
        if (isset($forecast['mape'])) {
            $mape += $forecast['mape'];
        }
    }

    if ($count > 0) {
        $mad /= $count;
    }
    if (count(array_filter(array_column($prevForecast, 'mse'))) > 0) {
        $mse /= count(array_filter(array_column($prevForecast, 'mse')));
    }
    if (count(array_filter(array_column($prevForecast, 'mape'))) > 0) {
        $mape /= count(array_filter(array_column($prevForecast, 'mape')));
    }
}

return [
    'no' => 1,
    'kd_sparepart' => $kdSparepart,
    'periode' => date('d F Y', strtotime('+1 month', strtotime($lastData['periode']))),
    'actual' => null,
    'forecast' => round($nextForecast),
    'mad' => $mad,
    'mse' => $mse,
    'mape' => $mape,
];
}

private function saveForecastResults($forecast)
{
    // Hapus data peramalan sebelumnya
    DB::table('forecast_results')->truncate();

    // Simpan hasil peramalan ke database
    foreach ($forecast as $data) {
        $no = $no = $data['no'];;
        $kdSparepart = $data['kd_sparepart'];

        DB::table('forecast_results')->insert([
            'no' => $no,
            'kd_sparepart' => $kdSparepart,
            'periode' => $data['periode'],
            'actual' => $data['actual'],
            'forecast' => $data['forecast'],
            'mad' => $data['mad'],
            'mse' => $data['mse'],
            'mape' => $data['mape'],
        ]);
    }
}

}
