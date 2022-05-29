<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use App\Table;
use App\Cart;
use App\ProductImage;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getAll(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'user_id' => 'integer',
            'owner_id' => 'integer'
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
            $oID = $req['owner_id'];
            $uID = $req['user_id'];
            $limit = $req['limit'];
            $offset = $req['offset'];

            if ($uID) {
                $data = Cart::GetAllByUserID($limit, $offset, $uID);
            } else {
                if ($oID) {
                    $data = Cart::GetAllByOwnerID($limit, $offset, $oID);
                } else {
                    $data = Cart::GetAll($limit, $offset);
                }
            }

            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $cart = $dump[$i];
                    $cart['customer'] = Customer::where(['id' => $cart['owner_id']])->first();
                    $cart['table'] = Table::where(['id' => $cart['owner_id']])->first();
                    array_push($newPayload, $cart);
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
            'cart_id' => 'required|string'
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
            $data = Cart::where(['cart_id' => $req['cart_id']])->first();
            
            if ($data) 
            {
                $data['customer'] = Customer::where(['id' => $data['owner_id']])->first();
                $data['table'] = Table::where(['id' => $data['owner_id']])->first();
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

    public function getCountByID(Request $req)
    {
        $response = [];

        $id = Auth()->user()->id;
        $data = Cart::GetCountByID($id);
        
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

        return response()->json($response, 200);
    }

    public function getCountAll(Request $req)
    {
        $response = [];

        $id = Auth()->user()->id;
        $data = [
            'all' => Cart::GetCountByID($id),
            'allAdmin' => Cart::GetCountAll()
        ];
        
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

        return response()->json($response, 200);
    }

    public function getCountCustomerAll(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'owner_id' => 'required|integer'
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
            $id = $req['owner_id'];
            $data = Cart::GetCountByCustomerID($id);
            
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

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'cart_id' => 'required|string|min:0|max:17|unique:carts',
            'toping_price' => 'required|integer',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'product_detail' => 'required|string',
            'product_id' => 'required|integer',
            'proddetail_id' => 'required|integer'
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
                'cart_id' => $req['cart_id'],
                'toping_price' => $req['toping_price'],
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_image' => $req['product_image'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'product_toping' => $req['product_toping'],
                'owner_id' => Auth()->user()->id,
                'product_id' => $req['product_id'],
                'proddetail_id' => $req['proddetail_id'],
                'toping_id' => $req['toping_id'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Cart::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Cart::where(['cart_id' => $req['cart_id']])->first()
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
            'id' => 'required|integer|min:0',
            'cart_id' => 'required|string|min:0|max:17',
            'toping_price' => 'required|integer',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'product_detail' => 'required|string',
            'product_id' => 'required|integer',
            'proddetail_id' => 'required|integer'
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
                'cart_id' => $req['cart_id'],
                'toping_price' => $req['toping_price'],
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                // 'product_image' => $req['product_image'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'product_toping' => $req['product_toping'],
                'product_id' => $req['product_id'],
                'proddetail_id' => $req['proddetail_id'],
                'toping_id' => $req['toping_id'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Cart::where(['id' => $req['id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Cart::where(['cart_id' => $req['cart_id']])->first()
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
            'cart_id' => 'required|string|min:0|max:17',
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
            $data = Cart::where(['cart_id' => $req['cart_id']])->delete();

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

    public function deleteByUserID(Request $req)
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
            $data = Cart::where(['owner_id' => $req['owner_id']])->delete();

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
