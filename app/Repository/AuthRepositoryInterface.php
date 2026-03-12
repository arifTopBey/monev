<?php

namespace App\Repository;

use App\Interface\AuthIterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepositoryInterface implements AuthIterface{

      // Cek apakah email & password cocok
    public function checkCredentials(array $data){

        // $user = User::where('email', $data['email'])->first();

        // if (!$user || !Hash::check($data['password'], $user->password)) {
        //     return null;
        // }

        // return $user;
        $user = User::where('email', $data['email'])->first();

    // Hanya return user jika password cocok, jika tidak return null
        if ($user && Hash::check($data['password'], $user->password)) {
            return $user;
        }

        return null;
    }

    // Buat token Sanctum
    public function generateToken($user,  $deviceName = null){

        // Cek keamanan: Pastikan $user bukan null
        if (!$user) return null;

        // Menghapus token lama agar tidak menumpuk (opsional)
        $name = $deviceName ?? 'main_access_token';

        $user->tokens()->delete();

        // Simpan hasil createToken ke variabel
        $tokenResult = $user->createToken($name);

        // return $user->createToken($name)->plainTextToken;
        return [
            'plainTextToken' => $tokenResult->plainTextToken,
            'tokenObject' => $tokenResult->accessToken
        ];

    }

    public function logout($user){
        return $user->currentAccessToken()->delete();
    }
}
