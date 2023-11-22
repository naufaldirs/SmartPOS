<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function home() {
        return view('home');
    }
    public function loginview() {
        return view('login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);
    
        $user = User::where('nip', $credentials['nip'])->first();
    
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Login successful
            Auth::login($user);
            $request->session()->regenerate();
            Session::put([
                'role' => $user->role,
                'nip' => $user->nip,
            ]);   
            session(['id_user' => $user->id_user]);         
            return redirect()->intended('/profile');
        } else {
            // Login failed
            return redirect()->route('login')->with('error', 'NIP / Password anda salah');
        }
}
public function logout(Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}
}
