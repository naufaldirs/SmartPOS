<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function pelanggan() {
        $limit = 5; // Jumlah data per halaman
        $pelanggans  = Pelanggan::paginate($limit);
        
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function tambahpelangganview() {
        return view('pelanggan.tambah');
    }

    public function tambahpelanggankasirview() {
        return view('pelanggan.tambahkasir');
    }
    public function tambahpelanggan(Request $request) {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan')->with('success', 'Pelanggan created successfully.');
    }

    public function tambahpelanggankasir(Request $request) {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
        ]);

        Pelanggan::create($request->all());

        return redirect()->back()->with('success', 'Pelanggan created successfully.');
    }

    public function ubahpelangganview($id_pelanggan) {
        
        $pelanggan = Pelanggan::find($id_pelanggan);

        if (!$pelanggan) {
            return redirect()->route('pelanggan')->with('error', 'Barang tidak ditemukan.');
        }

        return view('pelanggan.ubah', compact('pelanggan'));
    }

    public function ubahpelanggan(Request $request, $id_pelanggan) {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
        ]);

        $pelanggan = Pelanggan::findOrFail($id_pelanggan);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan')->with('success', 'Pelanggan updated successfully.');
    }

    public function hapuspelanggan($id_pelanggan) {
           // Find the Costumer to be deleted
           $pelanggan = Pelanggan::find($id_pelanggan);

           if (!$pelanggan) {
               // If the Costumer doesn't exist, redirect with a message or handle the error as you like
               return redirect()->route('pelanggan')->with('error', 'Data Tidak Ditemukan.');
           }
   
           // Delete the Costumer
           $pelanggan->delete();
   
           return redirect()->route('pelanggan')->with('success', 'Data telah dihapus.');
    }
}
