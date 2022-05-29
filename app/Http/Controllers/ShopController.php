<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Shop;
use App\Table;
use App\Shift;
use App\Customer;
use App\Catalog;
use App\Employee;
use App\Cart;
use App\WisheList;
use Image;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getAllOnlyShop(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'status' => 'string'
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
            $status = $req['status'];
            $limit = $req['limit'];
            $offset = $req['offset'];

            $stt = $status ? ['status' => $status] : [];

            $data = Shop::where($stt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            
            if ($data) 
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => $data 
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

    public function getByIDOnlyShop(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'shop_id' => 'required|string|min:0|max:17',
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
            $shop_id = $req['shop_id'];
            $data = Shop::where(['shop_id' => $shop_id])->first();
            
            if ($data) 
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => $data 
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
    
    public function getAll(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'status' => 'string'
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
            $status = $req['status'];
            $limit = $req['limit'];
            $offset = $req['offset'];

            $stt = $status ? ['status' => $status] : [];
            $newStt = array_merge($stt, ['user_id' => Auth()->user()->id]);

            if (Auth()->user()->role_id == 1) {
                $data = Shop::where($stt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            } else {
                $data = Shop::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            }
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $shop = $dump[$i];
                    $stt = $status ? ['status' => $status] : [];
                    $catalogs = Catalog::GetAllByShopID(10, 0, $shop['id']);
                    $tables = Table::where(['shop_id' => $shop['id']])->get();
                    $shifts = Shift::where(['shop_id' => $shop['id']])->get();
                    $customers = Customer::where(['shop_id' => $shop['id']])->get();
                    $employees = Employee::where(['shop_id' => $shop['id']])->get();
                    $payload = [
                        'shop' => $shop,
                        'catalogs' => $catalogs,
                        'tables' => $tables,
                        'shifts' => $shifts,
                        'customers' => $customers,
                        'employees' => $employees
                    ];
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
            'shop_id' => 'required|string|min:0|max:17',
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
            $shop_id = $req['shop_id'];
            $data = Shop::where(['shop_id' => $shop_id])->first();
            
            if ($data) 
            {
                $catalogs = Catalog::GetAllByShopID(10, 0, $data['id']);
                $tables = Table::where(['shop_id' => $data['id']])->get();
                $shifts = Shift::where(['shop_id' => $data['id']])->get();
                $customers = Customer::where(['shop_id' => $data['id']])->get();
                $newPayload = [
                    'shop' => $data,
                    'catalogs' => $catalogs,
                    'tables' => $tables,
                    'shifts' => $shifts,
                    'customers' => $customers
                ];

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

    public function removeImage(Request $req) 
    {
        $validator = Validator::make($req->all(), [
            'shop_id' => 'required|string|min:0|max:17',
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
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $filename = Shop::where(['shop_id' => $req['shop_id']])->first()->image;
            $data = Shop::where(['shop_id' => $req['shop_id']])->update($payload);

            if ($data)
            {
                unlink(public_path('contents/shops/thumbnails/'.$filename));
				unlink(public_path('contents/shops/covers/'.$filename));

                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Shop::where(['shop_id' => $req['shop_id']])->first()
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
            'shop_id' => 'required|string|min:0|max:17',
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
            $id = $req['shop_id'];
            $image = $req['image'];

            $chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());
			$width = getimagesize($image)[0];
			$height = getimagesize($image)[1];

            //save image to server
			//creating thumbnail and save to server
			$destination = public_path('contents/shops/thumbnails/'.$filename);
			$img = Image::make($image->getRealPath());
			$thumbnail = $img->resize(400, 400, function ($constraint) {
					$constraint->aspectRatio();
				})->save($destination); 

			//saving image real to server
			$destination = public_path('contents/shops/covers/');
			$real = $image->move($destination, $filename);

            if ($thumbnail && $real) 
			{
                $payload = [
                    'image' => $filename,
                    'updated_by' => Auth()->user()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
                $data = Shop::where(['shop_id' => $req['shop_id']])->update($payload);
    
                if ($data)
                {
                    $response = [
                        'message' => 'proceed success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => Shop::where(['shop_id' => $req['shop_id']])->first()
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

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'shop_id' => 'required|string|min:0|max:17|unique:shops',
            'name' => 'required|string',
            'about' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email|string',
            'phone' => 'required|string',
            'open_day' => 'required|string',
            'close_day' => 'required|string',
            'open_time' => 'required|string',
            'close_time' => 'required|string',
            'is_available' => 'required|integer',
            'status' => 'required|string'
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
                'shop_id' => $req['shop_id'],
                'name' => $req['name'],
                'about' => $req['about'],
                'location' => $req['location'],
                'email' => $req['email'],
                'phone' => $req['phone'],
                'open_day' => $req['open_day'],
                'close_day' => $req['close_day'],
                'open_time' => $req['open_time'],
                'close_time' => $req['close_time'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'user_id' => Auth()->user()->id,
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Shop::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Shop::where(['shop_id' => $req['shop_id']])->first()
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
            'shop_id' => 'required|string|min:0|max:17',
            'name' => 'required|string',
            'about' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'open_day' => 'required|string',
            'close_day' => 'required|string',
            'open_time' => 'required|string',
            'close_time' => 'required|string',
            'is_available' => 'required|integer',
            'status' => 'required|string'
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
                'about' => $req['about'],
                'location' => $req['location'],
                'email' => $req['email'],
                'phone' => $req['phone'],
                'open_day' => $req['open_day'],
                'close_day' => $req['close_day'],
                'open_time' => $req['open_time'],
                'close_time' => $req['close_time'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'user_id' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Shop::where(['shop_id' => $req['shop_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Shop::where(['shop_id' => $req['shop_id']])->first()
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
            'shop_id' => 'required|string|min:0|max:17',
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
            $data = Shop::where(['shop_id' => $req['shop_id']])->delete();

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

    public function exit(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'owner_id' => 'required|integer',
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
            $cart = Cart::where(['owner_id' => $req['owner_id']])->delete();
            $wh = WisheList::where(['owner_id' => $req['owner_id']])->delete();

            if ($cart || $wh)
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
