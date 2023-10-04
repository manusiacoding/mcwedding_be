<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Error;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $payload = $request->json()->all();

            return $payload;
        } catch (\Throwable $th) {
            return throw new Error($th);
        }
    }
}
