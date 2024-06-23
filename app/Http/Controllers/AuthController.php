<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\usuario;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'contraseña' => 'required',
        ]);

        $user = usuario::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json(['error' => 'Credenciales de inicio de sesión incorrectas'], 401);
        }

        if (Hash::check($credentials['contraseña'], $user->contraseña)) {
            $role = $user->id_rol == 1 ? 'admin' : 'vendedor';
            return response()->json(['role' => $role]);
        } else {
            return response()->json(['error' => 'datos  de inicio de sesión incorrectos'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    }
}