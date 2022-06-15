<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', [
        	'except' => [
        		'login'
        	]
        ]);
    }

    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $response = [];

        if ($validator->fails()) 
        {
            $response = [
                'message' => $validator->errors(),
                'status' => 'invalide',
                'code' => '201',
                'data' => []
            ];
        } 
        else 
        {
            $credentials = $req->only('email', 'password');
            $admin = Admin::where(['email'=> $req['email']])->first();

            if ($admin) 
            {
                if (Hash::check($req['password'], $admin->password)) 
                {
                    $response = [
                        'message' => 'login success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => [
                            'admin' => $admin,
                            'token' => $admin->createToken('my-token')->plainTextToken
                        ]
                    ];
                }
                else 
                {
                    $response = [
                        'message' => 'check back your password',
                        'status' => 'password-invalid',
                        'code' => '201',
                        'data' => []
                    ];
                }
            }
            else 
            {
                $response = [
                    'message' => 'check back your email address',
                    'status' => 'email-invalid',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function logout(Request $req)
    {
        $user = $req->user();
        $user->currentAccessToken()->delete();
        $response = [
            'message' => 'logout successfully',
            'status' => 'ok',
            'code' => '201',
            'data' => []
        ];

        return response()->json($response, 200);
    }

    public function me(Request $req)
    {
        $admin = $req->user();
        $token = $admin->currentAccessToken();
        $response = [
            'message' => 'process success',
            'status' => 'ok',
            'code' => '201',
            'data' => [
                'token' => $token,
                'admin' => $admin
            ]
        ];
     
        return response()->json($response, 200);
    }
}
