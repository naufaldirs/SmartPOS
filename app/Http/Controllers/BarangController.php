<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BarangController extends Controller
{

 public function informasi()
{
    $limit = 5; // Jumlah data per halaman
    $spareparts = Sparepart::paginate($limit);
    
    // Calculate the total sold for each sparepart
    $soldCounts = PenjualanDetail::groupBy('kd_sparepart')
    ->selectRaw('kd_sparepart, count(kd_sparepart) as total_sold')
    ->orderBy('total_sold', 'desc') // Menambahkan metode orderBy
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
        $harga = $request->input('harga');
        $stok = $request->input('stok');
    // Create a new sparepart instance
    $sparepart = new Sparepart([
        'kd_sparepart' => $request->input('kd_sparepart'),
        'nama_sparepart' => $request->input('nama_sparepart'),
        'harga' => $harga,
        'stok' => $stok,
        'total_harga' =>  $harga * $stok,
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

    public function tambahstokview($kd_sparepart) {

        $sparepart = Sparepart::find($kd_sparepart);

        if (!$sparepart) {
            return redirect()->route('spareparts.index')->with('error', 'Barang tidak ditemukan.');
        }

        return view('barang.tambahstok', compact('sparepart'));
   
    }

    public function tambahstok(Request $request, $kd_sparepart) {
        try {
            // Validasi input, jika diperlukan
            $request->validate([
                'kd_sparepart' => 'required',
                'nama_sparepart' => 'required',
                'harga' => 'required|numeric',
                'stoklama' => 'required|numeric',
                'stokbaru' => 'required|numeric',
            ]);
    
            // Ambil data dari request
            $harga = $request->input('harga');
            $stoklama = $request->input('stoklama');
            $stokbaru = $request->input('stokbaru');
    
            // Hitung total stok
            $stok = $stoklama + $stokbaru;
    
            // Perbarui data menggunakan Eloquent
            Sparepart::where('kd_sparepart', $kd_sparepart)->update([
                'kd_sparepart' => $request->input('kd_sparepart'),
                'nama_sparepart' => $request->input('nama_sparepart'),
                'harga' => $harga,
                'stok' => $stok,
                'total_harga' => $harga * $stok,
            ]);
    
            // Redirect dengan pesan sukses
            return redirect()->route('barang')->with('success', 'Sparepart updated successfully.');
    
        } catch (QueryException $e) {
            // Tangani kesalahan basis data
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan basis data: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
       }

    public function ubahbarang(Request $request, $kd_sparepart) {
     // Validasi data dari request jika diperlukan
    $request->validate([
        'kd_sparepart' => 'required|string', // Assuming kd_sparepart is a string
        'nama_sparepart' => 'required|string',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);
    $harga = $request->input('harga');
    $stok = $request->input('stok');
    $sparepart = Sparepart::find($kd_sparepart);    
     // Update data pengguna
     $sparepart->kd_sparepart = $request->input('kd_sparepart');
     $sparepart->nama_sparepart = $request->input('nama_sparepart');
     $sparepart->harga = $harga;
     $sparepart->stok = $stok;
     $sparepart->total_harga =  $harga * $stok;
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
