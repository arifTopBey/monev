<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStoreRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interface\AuthIterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

     private AuthIterface $authRepositoryInterface;

    public function __construct(AuthIterface $authRepositoryInterface){
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function index(){

        return view('frontend.auth.index');
    }

    public function login(LoginStoreRequest $request){

        $credentials = $request->validated();
        // $credentials = $request->validate([
        //     'email' => 'required|email|max:255',
        //     'password' => 'required|max:255',
        // ]);

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

    public function profile($id){

        $user = User::findOrFail($id);

            if ($user->id !== Auth::id()) {
                return redirect()->route('monev')->with('error', 'Akses Ditolak');
            }

        return view('admin.porfile.index', compact('user'));
    }
   public function updateProfile(UpdateProfileRequest $request, $id)
{
    DB::beginTransaction();

    try {

        $validated = $request->validated();
        $nowLoginUser = Auth::user();
        $user = User::find($nowLoginUser->id)->first();

        if (isset($validated['username'])) {
            $user->username = $validated['username'];
        }

        if (isset($validated['firstname'])) {
            $user->firstname = $validated['firstname'];
        }

        if (isset($validated['lastname'])) {
            $user->lastname = $validated['lastname'];
        }

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
        }

        if (isset($validated['mobile_no'])) {
            $user->mobile_no = $validated['mobile_no'];
        }

        $user->save();

        DB::commit();

        return redirect()->route('admin.auth.profile', $nowLoginUser->id)
            ->with('success', 'Profil berhasil diperbarui');

    } catch (Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->with('error', 'Terjadi kesalahan saat memperbarui profil')
            ->withInput();
    }
}
    
    public function editPassword($id){

            $user = User::findOrFail($id);

            if ($user->id !== Auth::id()) {
                return redirect()->route('monev')->with('error', 'Akses Ditolak');
            }
            
        return view('admin.porfile.editPassword', compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
{
    DB::beginTransaction();

    $validated = $request->validated();

    try {

        $nowLoginUser = Auth::user();
        $user = User::find($nowLoginUser->id)->first();
        $user->password = bcrypt($validated['password']);

        $user->save();

        DB::commit();

        return redirect()->route('admin.auth.profile', $nowLoginUser->id)
            ->with('success', 'Profil berhasil diperbarui');

    } catch (Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->with('failed', 'Terjadi kesalahan saat memperbarui profil')
            ->withInput();
    }
}

}
