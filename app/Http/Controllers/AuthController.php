<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\RolePermission;
use App\Role;
use App\Shop;
use App\Employee;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', [
        	'except' => [
        		'login', 
        		'register'
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
            $user = User::where(['email'=> $req['email']])->first();

            if ($user) 
            {
                if (Hash::check($req['password'], $user->password)) 
                {
                    $data = User::GetUserWithEmail($req['email']);
                    $permission = RolePermission::GetAllSmallByID(1000, 0, $data['role_id']);
                    $role = Role::where(['id' => $data['role_id']])->first();
                    $employee = null;
                    $shop = null;
                    
                    if ($user->owner_id == null) {
                        $shop = Shop::where(['user_id' => $user->id])->get();
                    } else {
                        $employee = Employee::where(['id' => $user->owner_id])->first();
                        if ($employee) {
                            $shop = Shop::where(['id' => $employee->shop_id])->get();
                        }
                    }

                    $response = [
                        'message' => 'login success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => [
                            'user' => $data,
                            'role' => $role,
                            'permissions' => $permission,
                            'token' => $user->createToken('my-token')->plainTextToken,
                            'shop' => $shop,
                            'employee' => $employee
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

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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
            $data = [
                'name' => $req['name'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
                'username' => explode('@', $req['email'])[0],
                'enabled' => false,
                'role_id' => '2'
            ];

            $rest = User::insert($data);
            if ($rest) 
            {
                $response = [
                    'message' => 'register success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => []
                ];
            }
            else 
            {
                $response = [
                    'message' => 'register failed',
                    'status' => 'unauthorized',
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
        $user = $req->user();
        $data = User::GetUserWithEmail(Auth()->user()->email);
        $permission = RolePermission::GetAllSmallByID(1000, 0, $data['role_id']);
        $role = Role::where(['id' => $data['role_id']])->first();
        $employee = Employee::where(['id' => $user->owner_id])->first();
        $token = $user->currentAccessToken();
        
        if ($data->role_name == "employee") {
            $shop = Shop::where(['id' => $employee->shop_id])->get();
        } else {
            $shop = Shop::where(['user_id' => $user->id])->get();
        }

        $response = [
            'message' => 'process success',
            'status' => 'ok',
            'code' => '201',
            'data' => [
                'token' => $token,
                'user' => $data,
                'role' => $role,
                'permissions' => $permission,
                'shop' => $shop,
                'employee' => $employee
            ]
        ];
     
        return response()->json($response, 200);
    }
}
