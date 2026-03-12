<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginStoreRequest;
use App\Interface\AuthIterface;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    private AuthIterface $authRepositoryInterface;

    public function __construct(AuthIterface $authRepositoryInterface){
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function login(LoginStoreRequest $request){

        // $validated = $request->validated();
        // $deviceName = $request->userAgent() ?? 'unknown_device';
        // $user = $this->authRepositoryInterface->checkCredentials($validated);

        // $token = $this->authRepositoryInterface->generateToken($user, $deviceName);

        $validated = $request->validated();
        $deviceName = $request->userAgent() ?? 'unknown_device';
        $user = $this->authRepositoryInterface->checkCredentials($validated);

        $tokenData = $this->authRepositoryInterface->generateToken($user, $deviceName);

        // Ambil durasi expire dari config (dalam menit)
        $expiration = config('sanctum.expiration');

        // Hitung waktu expired
        $expiresAt = $expiration ? $tokenData['tokenObject']->created_at->addMinutes($expiration) : null;

        return response()->json([
            'success' => true,
            'message' => 'login berhasil',
            'token' => $tokenData['plainTextToken'],
            'expires_at' => $expiresAt ? $expiresAt->toDateTimeString() : null,
        ]);
    }

    public function logout(Request $request)
{
    $this->authRepositoryInterface->logout($request->user());

    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil'
    ]);
}
}
