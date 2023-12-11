<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    function laporankeuangan() {
        return view("laporan.keuangan");
    }

    public function generateFinancialReport($selectedDate = null)
    {
        // Query untuk menghitung laba kotor, laba bersih, transaksi, dan pendapatan
        $query = DB::table('penjualan');

        // Filter berdasarkan tanggal jika ada
        if ($selectedDate === 'today') {
            $query->whereDate('tgl_nota', Carbon::today());
        } elseif ($selectedDate === 'this_week') {
            $query->whereBetween('tgl_nota', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectedDate === 'this_month') {
            $query->whereMonth('tgl_nota', Carbon::now()->month);
        } elseif ($selectedDate === 'this_year') {
            $query->whereYear('tgl_nota', Carbon::now()->year);
        }

        $totalPenjualan = $query->sum('total');
        $labaKotor = $totalPenjualan;
        $labaBersih = $labaKotor * 0.8; // Misalnya, laba bersih adalah 80% dari laba kotor
        $transaksiCount = $query->count();
        $pendapatanHariIni = $totalPenjualan;

        // Mengembalikan hasil dalam bentuk JSON
        return response()->json([
            'labaKotor' => $labaKotor,
            'labaBersih' => $labaBersih,
            'transaksiCount' => $transaksiCount,
            'pendapatanHariIni' => $pendapatanHariIni,
        ]);

 
}
public function penjualanChart()
{
    $penjualanData = Penjualan::selectRaw("DATE_FORMAT(tgl_nota, '%Y-%m') as bulan, SUM(total) as total_penjualan")
        ->groupBy('bulan')
        ->get();

    return view('laporan.chart', compact('penjualanData'));
}
}