<?php

namespace App\Http\Controllers;


use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TransaksiKasirController extends Controller
{
      public function detailindex($no_nota) {
        $penjualan = Penjualan::with(['pelanggan', 'users'])
        ->where('no_nota', $no_nota)
        ->firstOrFail();

    $detail_barang = PenjualanDetail::join('sparepart', 'penjualan_detail.kd_sparepart', '=', 'sparepart.kd_sparepart')
        ->where('penjualan_detail.no_nota', $no_nota)
        ->select('penjualan_detail.qty', 'sparepart.nama_barang', 'sparepart.harga', 'penjualan_detail.subtotal','penjualan_detail.kd_sparepart')
        ->get();

    return view('detailbarang.index', compact('penjualan', 'detail_barang','no_nota'));
    }
    public function tambahdetailview($no_nota)
    {
       // Fetch user data based on no_nota
       $penjualans = DB::table('penjualan')
       ->join('users', 'penjualan.id_user', '=', 'users.id_user')
       ->join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
       ->where('penjualan.no_nota', $no_nota)
       ->select('penjualan.no_nota', 'penjualan.no_po', 'users.nama_users', 'pelanggan.nama_pelanggan', 'penjualan.subtotal_total')
       ->first();

   return view('detailbarang.detailtambah', compact('penjualans', 'no_nota'));
    }


    public function transaksikasirview() {
        $pelanggans = Pelanggan::all();
        $user = session('id_user', '');
        // Mengambil data user_detail terkait
        $users = DB::table('user_detail')->where('id_user', $user)->first();

    // Fetch barang data
    $spareparts = DB::table('sparepart')->get();
 
        return view('transaksi.index', compact('spareparts','pelanggans','users'));
       }


public function transaksikasir(Request $request)
{
    $no_nota = $request->input('no_nota');
    $request->validate([
        'no_nota' => 'required|unique:penjualan,no_nota',
        'tgl_nota' => 'required|date',
        'pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        'user' => 'required|exists:users,id_user',
        'bayar' => 'required|numeric',
        'kembali' => 'required|numeric',
        'total' => 'required|numeric',
        'pembayaran' => 'required|in:Cash,E-Wallet',
        'kd_sparepart.*' => 'required|exists:sparepart,kd_sparepart',
        'qty.*' => 'required|numeric|min:1',
        'subtotal.*' => 'required|numeric|min:0',
    ]);
    try {
         // Gunakan transaksi database untuk menjamin integritas data
    DB::transaction(function () use ($request) {
        // Simpan data ke tabel Penjualan
        $penjualan = Penjualan::create([
            'no_nota' => $request->input('no_nota'),
            'tgl_nota' => now(),
            'total' => $request->input('total'),
            'bayar' => $request->input('bayar'),
            'pembayaran' => $request->input('pembayaran'),
            'kembali' => $request->input('kembali'),
            'id_pelanggan' => $request->input('pelanggan'),
            'id_user' => $request->input('user'),
            // Tambahkan field lainnya
        ]);

        // Simpan data ke tabel PenjualanDetail
        $penjualanDetailData = [];
        foreach ($request->input('kd_sparepart') as $key => $kd_sparepart) {
            $penjualanDetailData[] = [
                'qty' => $request->input('qty')[$key],
                'subtotal' => $request->input('subtotal')[$key],
                'no_nota' => $request->input('no_nota'),
                'kd_sparepart' => $kd_sparepart,
            ];
                        // Kurangkan stok Sparepart
            $sparepart = Sparepart::where('kd_sparepart', $kd_sparepart)->first();
            $sparepart->stok -= $request->input('qty')[$key];
            $sparepart->save();
        }

        PenjualanDetail::insert($penjualanDetailData);
    });

        return redirect()->route('cetakview', ['no_nota' => $no_nota])->with('success', 'Transaksi berhasil.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Transaksi gagal. Error: ' . $e->getMessage());
    }
}

public function cetakview($no_nota) {
    $penjualan = Penjualan::with('pelanggan', 'user', 'penjualanDetails.sparepart')->where('no_nota',$no_nota)->first();
    return view('transaksi.cetakview', compact('penjualan'));
}


public function cetakInvoice($no_nota)
{
    $penjualan = Penjualan::with('pelanggan', 'user', 'penjualanDetails.sparepart')->where('no_nota',$no_nota)->first();
    $pdf = PDF::loadView('transaksi.cetak', compact('penjualan'));
    set_time_limit(300);
    return $pdf->stream('invoice.pdf');
}

}
