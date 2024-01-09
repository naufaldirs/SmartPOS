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
        $today = Carbon::today();
        
        // Filter berdasarkan tanggal jika ada
        if ($selectedDate === 'today') {
            $query->whereDate('tgl_nota', Carbon::today());
            $totalPenjualan = $query->sum('total');
            $labaKotor = 'Rp. ' . number_format($totalPenjualan, 0, ',', '.');
            $labaBersih = 'Rp. ' . number_format(intval($totalPenjualan * 0.8), 0, ',', '.');
            $transaksiCount = $query->count();
            $pendapatanHariIni = 'Rp. ' . number_format(Penjualan::whereDate('created_at', $today)->sum('total'), 0, ',', '.');
        } elseif ($selectedDate === 'this_week') {
            $query->whereBetween('tgl_nota', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    
            $totalPenjualan = $query->sum('total');
            $labaKotor = 'Rp. ' . number_format($totalPenjualan, 0, ',', '.');
            $labaBersih = 'Rp. ' . number_format(intval($totalPenjualan * 0.8), 0, ',', '.');
            $transaksiCount = $query->count();
            $pendapatanHariIni = 'Rp. ' . number_format(Penjualan::whereDate('created_at', $today)->sum('total'), 0, ',', '.');
        } elseif ($selectedDate === 'this_month') {
            $query->whereMonth('tgl_nota', Carbon::now()->month);
    
            $totalPenjualan = $query->sum('total');
            $labaKotor = 'Rp. ' . number_format($totalPenjualan, 0, ',', '.');
            $labaBersih = 'Rp. ' . number_format(intval($totalPenjualan * 0.8), 0, ',', '.');
            $transaksiCount = $query->count();
            $pendapatanHariIni = 'Rp. ' . number_format(Penjualan::whereDate('created_at', $today)->sum('total'), 0, ',', '.');
        } elseif ($selectedDate === 'this_year') {
            $query->whereYear('tgl_nota', Carbon::now()->year);
            $totalPenjualan = $query->sum('total');
            $labaKotor = 'Rp. ' . number_format($totalPenjualan, 0, ',', '.');
            $labaBersih = 'Rp. ' . number_format(intval($totalPenjualan * 0.8), 0, ',', '.');
            $transaksiCount = $query->count();
            $pendapatanHariIni = 'Rp. ' . number_format(Penjualan::whereDate('created_at', $today)->sum('total'), 0, ',', '.');
        }
    
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
    $penjualanData = Penjualan::selectRaw("DATE_FORMAT(tgl_nota, '%Y-%m') as bulan, count(no_nota) as total_penjualan")
        ->groupBy('bulan')
        ->get();

    return view('laporan.chart', compact('penjualanData'));
}

public function laporanpajakview() {
    $salesData = Penjualan::selectRaw('YEAR(tgl_nota) as tahun, SUM(total) as totalPendapatan')
    ->groupBy('tahun')
    ->get();

    return view('laporan.pajak', compact('salesData'));
}

public function getSalesData()
{
    $salesData = Penjualan::selectRaw('YEAR(tgl_nota) as tahun, SUM(total) as totalPendapatan')
        ->groupBy('tahun')
        ->get();

    return response()->json($salesData);
}

}