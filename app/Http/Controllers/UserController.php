<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfile()
    {
                // Mengambil data user yang sedang login
        $user = session('id_user', '');


        // Mengambil data user_detail terkait
        $userDetail = DB::table('user_detail')->where('id_user', $user)->first();


        // Jika user_detail belum ada, kosongkan data
        if (!$userDetail) {
            $userDetail = (object) [
                'nama' => '',
                'nip' => '',
                'tgl_lahir' => '',
                'alamat' => '',
                'no_telp' => '',
                'email' => '',
            ];
        }

        return view('profile.index', [
            'userDetail' => $userDetail,
        ]);

    }

public function userview() {
    $limit = 5; // Jumlah data per halaman
    $userData = User::paginate($limit);
    
    return view('user.index', [
        'userData' => $userData,
        
    ]);
}

public function tambahuserview(){
    return view('user.tambah');
}

public function tambahuser(Request $request) {
    $jumlahUser = User::count();
    $id_user = $jumlahUser + 1;

    $request->validate([
        'nip' => 'required|unique:users,nip', // pastikan tabel user memiliki kolom nip
        'password' => 'required',
        'role' => 'required|in:admin,kasir,akuntan,manajer',
    ]);

    // Simpan user baru
    $user = User::create([
        'id_user' => $id_user,
        'nip' => $request->nip,
        'password' => bcrypt($request->password), // Jangan lupa hash password
        'role' => $request->role,
    ]);

    // Redirect ke halaman detail dengan membawa ID user
    return redirect()->route('tambahdetailuser', ['id_user' => $user->id_user]);
    
}
public function editUser($id_user)
{
    $user = User::find($id_user);

    if (!$user) {
        // If the petugas doesn't exist, redirect with a message or handle the error as you like
        return redirect()->route('manajemenuser')->with('error', 'Data tidak Ditemukan.');
    }
    // Tampilkan view edituserview dengan data user
    return view('user.ubah', compact('user'));
}

public function updateuser(Request $request, $id_user)
{
    // Validasi data dari request jika diperlukan
    $request->validate([
        'nip' => 'required|string',
        'password' => 'required|string',
        'role' => 'required|in:admin,kasir,akuntan,manajer',
    ]);

    // Temukan pengguna berdasarkan ID
    $user = User::find($id_user);

    if (!$user) {
        // Jika pengguna tidak ditemukan, redirect dengan pesan error
        return redirect()->route('manajemenuser')->with('error', 'Data tidak Ditemukan.');
    }

    // Update data pengguna
    $user->nip = $request->input('nip');
    $user->password = Hash::make($request->input('password')); // Hash password
    $user->role = $request->input('role');

    // Simpan perubahan
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('manajemenuser')->with('success', 'Data Pengguna berhasil diupdate.');
}

public function hapusUser($id_user)
{
         // Find the Costumer to be deleted
         $user = User::find($id_user);

         if (!$user) {
             // If the Costumer doesn't exist, redirect with a message or handle the error as you like
             return redirect()->route('manajemenuser')->with('error', 'Data Tidak Ditemukan.');
         }
 
         // Delete the Costumer
         $user->delete();
 
         return redirect()->route('manajemenuser')->with('success', 'Data telah dihapus.');
}

public function detailuser($id_user) {
 
         // Ambil data user berdasarkan ID
        $user = User::findOrFail($id_user);
        // Tampilkan halaman detail user

        // Mengambil data user_detail terkait
        $userDetail = DB::table('user_detail')->where('id_user', $user->id_user)->first();
            
                    // Jika user_detail belum ada, kosongkan data
                    if (!$userDetail) {
                        $userDetail = (object) [
                            'nama' => '',
                            'nip' => '',
                            'tgl_lahir' => '',
                            'alamat' => '',
                            'no_telp' => '',
                            'email' => '',
                            'foto' => 'Foto tidak Ditemukan',
                        ];
                    }
            
                    return view('detailuser.index', [
                        'userDetail' => $userDetail,
                        'user' => $user
                    ]);
}

public function detailtambahview($id_user) {
    $user = User::find($id_user);
    $userDetail = DB::table('user_detail')->where('id_user', $user->id_user)->first();

    return view('detailuser.tambah', [
        'userDetail' => $userDetail,
        'user' => $user
    ]);
}

public function tambahDetailUser(Request $request, $id_user) {
    // Validate the request data
    $request->validate([
        'nama' => 'required|string',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'email' => 'required|email',
        'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the user by ID
    $user = User::find($id_user);

    // Handle file upload
    $fileName = null;
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/user_photos', $fileName); // Store the file in the public disk under 'user_photos' directory
    }

    // Use updateOrcreate to either create a new record or update an existing one
    UserDetail::updateOrcreate(
        ['id_user' => $user],
        [
            'id_user' => $id_user,
            'nama' => $request->input('nama'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            'email' => $request->input('email'),
            'foto' => $fileName,
        ]
    );

    return redirect()->route('detailuserview', ['id_user'=>$user])->with('success', 'Data telah Ditambahkan.');
}


}