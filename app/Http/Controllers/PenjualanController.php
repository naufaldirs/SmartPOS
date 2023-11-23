<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Sparepart;
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
        $penjualanData = Penjualan::with(['pelanggan', 'user'])->orderByDesc('no_nota')
        ->offset($offset)
        ->limit($limit)
        ->get();
        return view('penjualan.index', [
            'penjualanData' => $penjualanData,
            'total_pages' => $total_pages,
            'currentPage' => $page,
        ]);
    }
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $users = User::all();

        return view('penjualan.tambah', compact('pelanggan', 'users'));
    }

    public function store(Request $request)
    {
        $no_nota = $request->input('no_nota');
        $request->validate([
            'no_nota' => 'required|integer',
            'no_po' => 'required|string',
            'pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'users' => 'required|exists:users,id_user',
        ]);

        $penjualan = new Penjualan();
        $penjualan->no_nota = $request->input('no_nota');
        $penjualan->total = 0;
        $penjualan->id_pelanggan = $request->input('pelanggan');
        $penjualan->id_user = $request->input('users');
        $penjualan->save();

        return redirect()->route('indexdetail', ['no_nota' => $no_nota])
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }
    public function edit($no_nota)
    {
        $penjualan = Penjualan::findOrFail($no_nota);
        return view('penjualan.ubahpenjualan', compact('penjualan'));
    }

    public function update(Request $request, $no_nota)
    {
        $penjualan = Penjualan::findOrFail($no_nota);
        $penjualan->no_po = $request->input('no_po');
        $penjualan->save();

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
    public function tambahdetail($no_nota)
    {
       // Fetch user data based on no_nota
       $penjualanData = DB::table('penjualan')
       ->join('users', 'penjualan.id_user', '=', 'users.id_user')
       ->join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
       ->where('penjualan.no_nota', $no_nota)
       ->select('penjualan.no_nota', 'penjualan.no_po', 'users.nama_users', 'pelanggan.nama_pelanggan', 'penjualan.subtotal_total')
       ->first();
   // Fetch barang data
   $barangData = DB::table('sparepart')->get();

   return view('detailbarang.detailtambah', compact('penjualanData', 'barangData','no_nota'));
    }



    public function simpandetail(Request $request, $no_nota)
    {

        $qty = intval($request->input('qty'));
        $kd_sparepart = $request->input('barang');
        
        $barang = Sparepart::find($kd_sparepart);
        $harga = $barang->harga;

        $subtotal = intval($request->input('subtotal'));

        // Check if the selected barang already exists in detail_barang table
        $result_check = DB::table('penjualan_detail')
        ->where('no_nota', $no_nota)
        ->where('kd_sparepart', $kd_sparepart)
        ->count();

    if ($result_check > 0) {
        // Item already exists in the cart, show an error message
        return redirect()->back()->with('error_message', 'Barang sudah ada dalam Keranjang.');
    } else {
                // Insert data into detail_barang table
                DB::table('penjualan_detail')->insert([
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                    'kd_sparepart' => $kd_sparepart,
                    'no_nota' => $no_nota,
                ]);
        
                // Update subtotal_total in penjualan table
                $this->updatesubtotalTotal($no_nota);
        
                return redirect()->route('indexdetail', ['no_nota' => $no_nota])
                ->with('harga', $harga)
                ->with('subtotal', $subtotal);
    }


    }

    private function updatesubtotalTotal($no_nota)
    {
        $total_subtotal = DB::table('penjualan_detail')
            ->where('no_nota', $no_nota)
            ->sum('subtotal');

        DB::table('penjualan')
            ->where('no_nota', $no_nota)
            ->update(['subtotal_total' => $total_subtotal]);
    }
    public function getHargaSatuan($kd_sparepart)
{
    $hargaSatuan = Sparepart::where('kd_sparepart', $kd_sparepart)->value('harga');
    return response()->json(['harga' => $hargaSatuan]);
}

public function hapusdetail($no_nota, $kd_sparepart)
{
    // Delete record from detail_barang table
    $deleted = DB::table('penjualan_detail')
        ->where('no_nota', $no_nota)
        ->where('kd_sparepart', $kd_sparepart)
        ->delete();

        
    if ($deleted) {
        // Update subtotal_total in penjualan table
        $total_subtotal = DB::table('penjualan_detail')
            ->where('no_nota', $no_nota)
            ->sum('subtotal');

        DB::table('penjualan')
            ->where('no_nota', $no_nota)
            ->update(['subtotal_total' => $total_subtotal]);

        return redirect()->route('indexdetail', ['no_nota' => $no_nota])->with('success_message', 'Entry berhasil dihapus.');
    } else {
        return redirect()->route('indexdetail', ['no_nota' => $no_nota])->with('error_message', 'Gagal menghapus entry.');
    }
}

public function showPrintout($no_nota)
{
    $data = DB::table('penjualan')
        ->join('users', 'penjualan.id_user', '=', 'users.id_user')
        ->join('pelanggan', 'penjualan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
        ->where('penjualan.no_nota', $no_nota)
        ->select('penjualan.no_nota', 'penjualan.no_po', 'users.nama_users', 'pelanggan.nama_pelanggan', 'pelanggan.alamat_pelanggan')
        ->first();

    $details = DB::table('penjualan_detail')
        ->join('sparepart', 'penjualan_detail.kd_sparepart', '=', 'sparepart.kd_sparepart')
        ->where('penjualan_detail.no_nota', $no_nota)
        ->select('penjualan_detail.qty', 'sparepart.nama_barang', 'sparepart.harga', 'penjualan_detail.subtotal')
        ->get();

    $subtotal_total = DB::table('penjualan_detail')
        ->join('penjualan', 'penjualan_detail.no_nota', '=', 'penjualan.no_nota')
        ->where('penjualan_detail.no_nota', $no_nota)
        ->sum('penjualan_detail.subtotal');

    return view('penjualan.cetak', [
        'data' => $data, 
        'details' => $details,
        'subtotal_total' => $subtotal_total,
    ]);
}


}
