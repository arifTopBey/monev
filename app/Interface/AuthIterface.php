<?php

namespace App\Interface;


interface AuthIterface {
    
     // Cek apakah email & password cocok
    public function checkCredentials(array $data);

    // Buat token Sanctum
    public function generateToken($user,  $deviceName = null);

    // Logout
    public function revokeToken($user);
}
