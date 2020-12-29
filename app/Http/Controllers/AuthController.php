<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json('Usuario ou senha inválidos', 401);
        }

        $token = JWT::encode(["email" => $request->email, "exp" => time() + 20], env('APP_TOKEN_KEY'), 'HS256');
        return response()->json(['access_token' => $token], 200, ['Content-Type: application/json']);
    }
}
