<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validáljuk a beérkező adatokat
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Megkeressük a felhasználót
        $user = User::where('email', $request->email)->first();

        // 3. Ellenőrizzük a jelszót
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Hibás adatok!'], 401);
        }

        // 4. Generálunk egy tokent a felhasználónak
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Visszaküldjük a tokent JSON formátumban
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
