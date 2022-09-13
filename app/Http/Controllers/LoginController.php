<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AuthSister;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    protected $authSister;

    public function __construct()
    {
        $this->authSister = new AuthSister;
    }

    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8001/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json($response->json(), $response->status());
    }

    public function logout(Request $request)
    {
        if ($request->header('Authorization') != null) {
            $token = explode(' ', $request->header('Authorization'));
            $valid = $this->authSister->verifyTokenRest($token[1]);

            if ($valid) {
                $response = Http::post('http://127.0.0.1:8001/api/logout', [
                    'token' => $token[1],
                ]);

                return handleResponse($response->json(), 'success');
            } else {
                return handleError('Unauthorized', [], 401);
            }
        } else {
            return handleError('Unauthorized', [], 401);
        }
    }
}
