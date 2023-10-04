<?php

namespace App\Http\Controllers\Authentication;

use Error;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status'  => false,
                'message' => 'Email atau Password salah!',
            ], 400);
        }

        $user = Auth::user();
        $role = Role::find($user->role_id);

        $user->role = $role->name;
        unset($user->role_id);
        unset($user->created_at);
        unset($user->updated_at);
        unset($user->email_verified_at);

        return response()->json([
            'status' => true,
            'data'   => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type'  => 'bearer',
                ]
            ]
        ], 200);
    }
}
