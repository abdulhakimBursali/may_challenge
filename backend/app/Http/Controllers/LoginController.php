<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $user = User::where('email', $loginRequest->email)->first();

        if (! $user || ! Hash::check($loginRequest->password, $user->password)) {
            return response([
                'message' => ['Invalid credentials.'],
            ], Response::HTTP_BAD_REQUEST);
        }

        $userToken = $user->createToken('api-token')->plainTextToken;

        return response()->json(['data' => ['message' => 'success', 'token' => $userToken]], Response::HTTP_OK);
    }
}
