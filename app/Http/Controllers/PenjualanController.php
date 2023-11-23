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
        $pelanggans = Pelanggan::all();
        $user = session('id_user', '');
        // Mengambil data user_detail terkait
        $users = DB::table('user_detail')->where('id_user', $user)->first();


        return view('penjualan.tambah', compact('pelanggans', 'users'));
    }

    public function store(Request $request)
    {
        $no_nota = $request->input('no_nota');
        $request->validate([
            'no_nota' => 'required|integer',
            'tgl_nota' => 'required',
            'pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        ]);



        $penjualan = new Penjualan();
        $penjualan->no_nota = $request->input('no_nota');
        $penjualan->no_nota = $request->input('tgl_nota');
        $penjualan->total = 0;
        $penjualan->id_pelanggan = $request->input('pelanggan');
        $penjualan->id_user = $request->input('users');
        $penjualan->save();

        return redirect()->route('transaksikasirview', ['no_nota' => $no_nota])
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

        $request->validate([
            'no_nota' => 'required|integer',
            'tgl_nota' => 'required',
            'pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'users' => 'required|exists:users,id_user',
        ]);

        $penjualanData = [
            'no_nota'=> $request->input('no_nota'),
            'tgl_nota' => now(),
            'total' => $request->input('total'),
            'bayar'=> $request->input('bayar'),
            'pembayaran'=> $request->input('pembayaran'),
            'kembali'=> $request->input('kembali'),
            'pelanggan' =>$request->input('pelanggan'),
            'users' => $request->input('user'),
            // Tambahkan field lainnya
        ];

        $penjualanDetailData = [
            [
                'kd_sparepart' => $request->input('kd_sparepart'),
                'qty' => $request->input('qty'),
                'subtotal' => $request->input('subtotal'),
                'no_nota'=> $request->input('no_nota'),

                // Tambahkan field lainnya
            ],
            // Tambahkan data PenjualanDetail lainnya
        ];

        try {
            // Gunakan transaksi database untuk menjamin integritas data
            DB::transaction(function () use ($penjualanData, $penjualanDetailData) {
                // Buat instance Penjualan
                $penjualan = Penjualan::create($penjualanData);

                // Hubungkan ID Penjualan ke setiap record PenjualanDetail
                $penjualanDetails = collect($penjualanDetailData)->map(function ($detail) use ($penjualan) {
                    return new PenjualanDetail(array_merge($detail, ['no_nota' => $penjualan->no_nota]));
                    
                });

                // Masukkan rekaman PenjualanDetail secara massal
                PenjualanDetail::insert($penjualanDetails->toArray());
            });

            // return redirect()->route('indexpenjualan')->with('success', 'Transaksi berhasil.');
        } catch (\Exception $e) {
            // return redirect()->route('transakasikasirview')->with('error', 'Transaksi gagal. Error: ' . $e->getMessage());
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
