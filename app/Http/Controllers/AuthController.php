<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'cliente', // Asignar rol por defecto
        ]);

        // Retornar una respuesta exitosa
        return response()->json($user, 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // Validar las credenciales
        if(!auth()->attempt($credentials)) {
            return response()->json(['error' => 'credenciales incorrectas'], 401);
        }

        // Generar un token de acceso
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        // Retornar el usuario y el token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Cierre de sesión exitoso'], 200);
    }
}