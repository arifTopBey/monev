<?php

namespace App\Http\Controllers;

use App\Interface\AuthIterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

     private AuthIterface $authRepositoryInterface;

    public function __construct(AuthIterface $authRepositoryInterface){
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function index(){

        return view('frontend.auth.index');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        // Gunakan repository untuk cek kecocokan data
        $user = $this->authRepositoryInterface->checkCredentials($credentials);

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        // if (Auth::attempt($credentials)) {

        //     $request->session()->regenerate();
        //     return redirect()->route('dashboard');
        // }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session dari server
        $request->session()->invalidate();

        // Buat ulang token CSRF agar tidak bisa dipakai lagi
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
