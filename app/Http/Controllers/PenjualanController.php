<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Sparepart;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class PenjualanController extends Controller
{
    public function history() {
       // Fetch data from the database (assuming you have a User and Penjualan model)
       $historyPayments = DB::table('pelanggan')
       ->join('penjualan', 'pelanggan.id_pelanggan', '=', 'penjualan.id_pelanggan')
       ->select('pelanggan.nama_pelanggan', 'pelanggan.no_telp', 'pelanggan.email', 'penjualan.tgl_nota')
       ->get(); // Retrieve all records

   // Manually paginate the results
   $perPage = 5; // Adjust the number of items per page
   $currentPage = request()->get('page', 1);
   $offset = ($currentPage - 1) * $perPage;
   $slicedHistoryPayments = array_slice($historyPayments->toArray(), $offset, $perPage);

   $historyPayments = new LengthAwarePaginator(
       $slicedHistoryPayments,
       count($historyPayments),
       $perPage,
       $currentPage,
       ['path' => url(route('historypembayaran'))]
   );

       return view('penjualan.history', compact('historyPayments'));
    }
    public function index(Request $request) {

        $limit = 5; // Jumlah data per halaman
        $total_records = Penjualan::count(); // Total data dalam tabel
        $total_pages = ceil($total_records / $limit); // Total halaman

        // Mendapatkan nomor halaman dari URL jika tersedia, jika tidak, default adalah halaman 1
        $page = $request->input('page', 1);

        // Menghitung offset pada query database
        $offset = ($page - 1) * $limit;
        $penjualanData = Penjualan::with(['pelanggan', 'user.userDetail'])->orderByDesc('no_nota')
        ->offset($offset)
        ->limit($limit)
        ->get();
        return view('penjualan.index', [
            'penjualanData' => $penjualanData,
            'total_pages' => $total_pages,
            'currentPage' => $page,
        ]);
    }


    public function edit($no_nota)
    {
        $penjualan = Penjualan::findOrFail($no_nota);
        return view('penjualan.ubahpenjualan', compact('penjualan'));
    }

    public function update(Request $request, $no_nota)
    {
        $request->validate([
            'no_nota' => 'required|',
            'tgl_nota' => 'required',
            'id_pelanggan' => 'required',
        ]);
        $penjualan = Penjualan::findOrFail($no_nota);
        $penjualan->update($request->all());

        return redirect()->route('indexpenjualan')->with('success', 'Data Penjualan berhasil diperbarui.');
    }

    public function destroy($no_nota)
    {
        $penjualan = Penjualan::where('no_nota', $no_nota)->first();
 
        // If the record is found, delete it
        if ($penjualan) {
            $penjualan->delete();
            // Redirect to the index page or wherever you want to go after deletion
            return redirect()->route('indexpenjualan')->with('success', 'Data Penjualan berhasil dihapus.');
        }
    
        // If the record is not found, redirect back with an error message
        return redirect()->back()->with('error', 'Data Penjualan tidak ditemukan.');
    }


}
