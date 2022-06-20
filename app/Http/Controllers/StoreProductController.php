<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Store;
use App\Category;
use App\Product;
use App\ProductImage;
use App\StoreProduct;

class StoreProductController extends Controller
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
            'status' => 'string',
            'store_id' => 'required|integer'
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
            $newStt = array_merge($stt, ['store_id' => $req['store_id']]);
            $data = StoreProduct::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            
            if ($data) 
            {
                $newPayload = array();
                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $store_product = $dump[$i];
                    $store = Store::where(['id' => $store_product['store_id']])->first();
                    $product = Product::where(['id' => $store_product['product_id']])->first(); 
                    $product['product_image'] = ProductImage::where(['product_id' => $product['id']])->get();
                    $category = Category::where(['id' => $store_product['category_id']])->first();
                    $payload = [
                        'store_product' => $store_product,
                        'product' => $product,
                        'category' => $category,
                        'store' => $store 
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
            'store_product_id' => 'required|string|min:0|max:17',
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
            $store_product_id = $req['store_product_id'];
            $data = StoreProduct::where(['store_product_id' => $store_product_id])->first();
            
            if ($data) 
            {
                $product = Product::where(['id' => $data['product_id']])->first(); 
                $product['product_image'] = ProductImage::where(['product_id' => $product['id']])->get();
                $store = Store::where(['id' => $data['store_id']])->first();
                $category = Category::where(['id' => $data['category_id']])->first();
                $payload = [
                    'store_product' => $data,
                    'product' => $product,
                    'category' => $category,
                    'store' => $store 
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

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'store_product_id' => 'required|string|min:0|max:17|unique:store_products',
            'store_id' => 'required|integer',
            'product_id' => 'required|integer',
            'category_id' => 'required|integer',
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
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
            $payload = [
                'store_product_id' => $req['store_product_id'],
                'store_id' => $req['store_id'],
                'product_id' => $req['product_id'],
                'category_id' => $req['category_id'],
                'note' => $req['note'],
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = StoreProduct::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => StoreProduct::where(['store_product_id' => $req['store_product_id']])->first()
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
            'store_product_id' => 'required|string|min:0|max:17',
            'category_id' => 'required|integer',
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
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
            $payload = [
                'category_id' => $req['category_id'],
                'note' => $req['note'],
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = StoreProduct::where(['store_product_id' => $req['store_product_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => StoreProduct::where(['store_product_id' => $req['store_product_id']])->first()
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
            'store_product_id' => 'required|string|min:0|max:17',
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
            $data = StoreProduct::where(['store_product_id' => $req['store_product_id']])->delete();

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
