<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

 public function informasi()
{
    $limit = 5; // Jumlah data per halaman
    $spareparts = Sparepart::paginate($limit);
    
    // Calculate the total sold for each sparepart
    $soldCounts = PenjualanDetail::groupBy('kd_sparepart')
        ->selectRaw('kd_sparepart, count(kd_sparepart) as total_sold')
        ->pluck('total_sold', 'kd_sparepart');

    
    return view('barang.informasi', [
        'spareparts' => $spareparts, 'terjual' => $soldCounts]);
}

    
    
    
    
    public function stokbarang() {

    $limit = 5; // Jumlah data per halaman
    $spareparts = Sparepart::paginate($limit);
    

    
    return view('barang.index', [
        'spareparts' => $spareparts]);
    }
    
    public function tambahbarangview() {
        return view('barang.tambah');
    }

    public function tambahbarang(Request $request) {
        // Validate the request data
    $request->validate([
        'kd_sparepart' => 'required|string', // Assuming kd_sparepart is a string
        'nama_sparepart' => 'required|string',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        // Add other validation rules as needed
    ]);

        // Check if the kd_sparepart already exists
        $existingSparepart = Sparepart::where('kd_sparepart', $request->input('kd_sparepart'))->first();

        if ($existingSparepart) {
            // Redirect back with an error message if kd_sparepart already exists
            return redirect()->back()->with('error', 'Barang dengan Kode Sparepart tersebut sudah ada.');
        }

    // Create a new sparepart instance
    $sparepart = new Sparepart([
        'kd_sparepart' => $request->input('kd_sparepart'),
        'nama_sparepart' => $request->input('nama_sparepart'),
        'harga' => $request->input('harga'),
        'stok' => $request->input('stok'),
        // Add other fields as needed
    ]);

    // Save the sparepart to the database
    $sparepart->save();
        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function ubahbarangview($kd_sparepart) {

        $sparepart = Sparepart::find($kd_sparepart);

        if (!$sparepart) {
            return redirect()->route('spareparts.index')->with('error', 'Barang tidak ditemukan.');
        }

        return view('barang.ubah', compact('sparepart'));
   
    }

    public function ubahbarang(Request $request, $kd_sparepart) {
                // Validasi data dari request jika diperlukan
    $request->validate([
        'kd_sparepart' => 'required|string', // Assuming kd_sparepart is a string
        'nama_sparepart' => 'required|string',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);
    $sparepart = Sparepart::find($kd_sparepart);    
        // Check if the kd_sparepart already exists
        $existingSparepart = Sparepart::where('kd_sparepart', $request->input('kd_sparepart'))->first();

        if ($existingSparepart) {
            // Redirect back with an error message if kd_sparepart already exists
            return redirect()->back()->with('error', 'Barang dengan Kode Sparepart tersebut sudah ada.');
        }
     // Update data pengguna
     $sparepart->kd_sparepart = $request->input('kd_sparepart');
     $sparepart->nama_sparepart = $request->input('nama_sparepart');
     $sparepart->harga = $request->input('harga');
     $sparepart->stok = $request->input('stok');
     // Simpan perubahan
     $sparepart->save();
 
     // Redirect dengan pesan sukses
     return redirect()->route('barang')->with('success', 'Data Pengguna berhasil diupdate.');
    }
    public function hapusbarang($sparepart) {
         // Find the Costumer to be deleted
         $sparepart = Sparepart::find($sparepart);

         if (!$sparepart) {
             // If the Costumer doesn't exist, redirect with a message or handle the error as you like
             return redirect()->route('barang')->with('error', 'Data Tidak Ditemukan.');
         }
 
         // Delete the Costumer
         $sparepart->delete();
 
         return redirect()->route('barang')->with('success', 'Data telah dihapus.');
    }
}
