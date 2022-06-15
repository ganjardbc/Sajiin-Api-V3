<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\RolePermission;
use App\Employee;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getAll(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer'
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
            $limit = $req['limit'];
            $offset = $req['offset'];
            $data = User::limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $user = $dump[$i];
                    $permission = RolePermission::GetAllByID(1000, 0, $user['role_id']);
                    $role = Role::where(['id' => $user['role_id']])->first();
                    $employee = Employee::where(['id' => $user['employee_id']])->first();
                    $payload = $user;
                    $payload['role'] = $role;
                    $payload['permissions'] = $permission;
                    $payload['employee'] = $employee;
                    array_push($newPayload, $payload);
                }

                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => $newPayload
                ];
            } 
            else 
            {
                $response = [
                    'message' => 'failed to get datas',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function getByID(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|string|min:0|max:17',
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
            $user_id = $req['user_id'];
            $data = User::where(['user_id' => $user_id])->first();
            
            if ($data) 
            {
                $permission = RolePermission::GetAllByID(1000, 0, $data['role_id']);
                $role = Role::where(['id' => $data['role_id']])->first();
                $employee = Employee::where(['id' => $data['employee_id']])->first();
                $payload = $data;
                $payload['role'] = $role;
                $payload['permissions'] = $permission;
                $payload['employee'] = $employee;

                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => $payload
                ];
            } 
            else 
            {
                $response = [
                    'message' => 'failed to get datas',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function removeImage(Request $req) 
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|integer|min:0|max:17',
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
            $payload = [
                'image' => '',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $filename = User::where(['id' => $req['id']])->first()->image;
            $data = User::where(['id' => $req['id']])->update($payload);

            if ($data)
            {
                unlink(public_path('contents/users/thumbnails/'.$filename));
				unlink(public_path('contents/users/covers/'.$filename));

                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => User::where(['id' => $req['id']])->first()
                ];
            }
            else 
            {
                $response = [
                    'message' => 'failed to remove image',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }
    }

    public function uploadImage(Request $req) 
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|integer|min:0|max:17',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000000'
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
            $id = $req['id'];
            $image = $req['image'];

            $chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());
			$width = getimagesize($image)[0];
			$height = getimagesize($image)[1];

            //save image to server
			//creating thumbnail and save to server
			$destination = public_path('contents/users/thumbnails/'.$filename);
			$img = Image::make($image->getRealPath());
			$thumbnail = $img->resize(400, 400, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destination); 

			//saving image real to server
			$destination = public_path('contents/users/covers/');
			$real = $image->move($destination, $filename);

            if ($thumbnail && $real) 
			{
                $payload = [
                    'image' => $filename,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                $data = User::where(['id' => $req['id']])->update($payload);
    
                if ($data)
                {
                    $response = [
                        'message' => 'proceed success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => User::where(['id' => $req['id']])->first()
                    ];
                }
                else 
                {
                    $response = [
                        'message' => 'failed to save',
                        'status' => 'failed',
                        'code' => '201',
                        'data' => []
                    ];
                }
            }
            else 
            {
                $response = [
                    'message' => 'failed to upload image',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function changePassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|string|min:0|max:17',
            'old_password' => 'required|string',
            'new_password' => 'required|string'
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
            $user = User::where(['user_id'=> $req['user_id']])->first();
            if (Hash::check($req['old_password'], $user->password)) 
            {
                $payload = [
                    'password' => Hash::make($req['new_password']),
                    'updated_by' => Auth()->user()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $data = User::where(['user_id' => $req['user_id']])->update($payload);

                if ($data)
                {
                    $response = [
                        'message' => 'proceed success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => []
                    ];
                }
                else 
                {
                    $response = [
                        'message' => 'failed to save',
                        'status' => 'failed',
                        'code' => '201',
                        'data' => []
                    ];
                }
            }
            else 
            {
                $response = [
                    'message' => 'check back your old password',
                    'status' => 'password-invalid',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|string|min:0|max:17|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'status' => 'required|string',
            'enabled' => 'required|boolean',
            'role_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'merchant_id' => 'required|integer',
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
            $payload = [
                'user_id' => $req['user_id'],
                'name' => $req['name'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
                'username' => explode('@', $req['email'])[0],
                'provider' => $req['provider'],
                'status' => $req['status'],
                'enabled' => $req['enabled'],
                'role_id' => $req['role_id'],
                'employee_id' => $req['employee_id'],
                'merchant_id' => $req['merchant_id']
            ];

            $data = User::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => User::GetUserWithEmail($payload['email'])
                ];
            }
            else 
            {
                $response = [
                    'message' => 'failed to save',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|string|min:0|max:17',
            'name' => 'required|string|max:255',
            'status' => 'required|string',
            'enabled' => 'required|boolean',
            'role_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'merchant_id' => 'required|integer',
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
            $payload = [
                'name' => $req['name'],
                'provider' => $req['provider'],
                'status' => $req['status'],
                'enabled' => $req['enabled'],
                'role_id' => $req['role_id'],
                'employee_id' => $req['employee_id'],
                'merchant_id' => $req['merchant_id']
            ];

            $data = User::where(['user_id' => $req['user_id']])->update($payload);

            if ($data)
            {
                $user = User::where(['user_id' => $req['user_id']])->first();

                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => User::GetUserWithEmail($user['email'])
                ];
            }
            else 
            {
                $response = [
                    'message' => 'failed to save',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|string|min:0|max:17',
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
            $data = User::where(['user_id' => $req['user_id']])->delete();

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => []
                ];
            }
            else 
            {
                $response = [
                    'message' => 'failed to delete',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }
}
