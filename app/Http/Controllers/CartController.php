<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use App\StoreTable;
use App\Store;
use App\Cart;
use App\Product;
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
            'customer_id' => 'required|integer'
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
            $data = Cart::where(['customer_id' => $req['customer_id']])->orderBy('id', 'desc')->get();

            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $cart = $dump[$i];
                    $customer = Customer::where(['id' => $cart['customer_id']])->first();
                    $store = Store::where(['id' => $cart['store_id']])->first();
                    $product = Product::where(['id' => $cart['product_id']])->first();
                    $product['product_images'] = ProductImage::where(['id' => $product['id']])->get();
                    $payload = [
                        'cart' => $cart,
                        'customer' => $customer,
                        'store' => $store,
                        'product' => $product
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
                $customer = Customer::where(['id' => $data['customer_id']])->first();
                $store = Store::where(['id' => $data['store_id']])->first();
                $product = Product::where(['id' => $data['product_id']])->first();
                $product['product_images'] = ProductImage::where(['id' => $product['id']])->get();
                $payload = [
                    'cart' => $data,
                    'customer' => $customer,
                    'store' => $store,
                    'product' => $product
                ];
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

    public function getCountByID(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'customer_id' => 'required|integer'
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
            $data = Cart::GetCountByID($req['customer_id']);
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
            'price' => 'required|integer',
            'discount' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'store_id' => 'required|integer',
            'customer_id' => 'required|integer'
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
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_image' => $req['product_image'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'note' => $req['note'],
                'status' => $req['status'],
                'customer_id' => $req['customer_id'],
                'product_id' => $req['product_id'],
                'store_id' => $req['store_id'],
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
            'cart_id' => 'required|string|min:0|max:17',
            'price' => 'required|integer',
            'discount' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'store_id' => 'required|integer',
            'customer_id' => 'required|integer'
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
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_image' => $req['product_image'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'note' => $req['note'],
                'status' => $req['status'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Cart::where(['cart_id' => $req['cart_id']])->update($payload);

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
