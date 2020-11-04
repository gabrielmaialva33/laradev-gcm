<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function login(Request $request)
    {
        $input = $request->only('nome_usuario', 'password');
        $jwt_token = null;

        if (!($jwt_token = JWTAuth::attempt($input))) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
}
