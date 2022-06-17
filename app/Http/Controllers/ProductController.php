<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductImage;
use App\Category;
use App\Merchant;

class ProductController extends Controller
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
            'merchant_id' => 'required|integer',
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
            $newStt = array_merge($stt, ['products.merchant_id' => $req['merchant_id']]);
            $data = Product::GetAll($limit, $offset, $newStt);
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $product = $dump[$i];
                    $stt = $status ? ['status' => $status] : [];
                    $detailImage = ProductImage::where(['product_id' => $dump[$i]['id']])->orderBy('id', 'desc')->get();
                    $detailCategory = Category::where(['id' => $dump[$i]['category_id']])->first();
                    $detailMerchant = Merchant::where(['id' => $dump[$i]['merchant_id']])->first();
                    $payload = [
                        'product' => $product,
                        'images' => $detailImage,
                        'category' => $detailCategory,
                        'merchant' => $detailMerchant
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
            'product_id' => 'required|string',
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
            $product_id = $req['product_id'];
            $data = Product::GetByID($product_id);
            
            if ($data) 
            {
                $dump = json_decode($data, true);
                $product = $dump;
                $detailImage = ProductImage::where(['product_id' => $dump['id']])->orderBy('id', 'desc')->get();
                $detailCategory = Category::where(['id' => $dump['category_id']])->first();
                $detailMerchant = Merchant::where(['id' => $dump['merchant_id']])->first();
                $newPayload = [
                    'product' => $product,
                    'images' => $detailImage,
                    'category' => $detailCategory,
                    'merchant' => $detailMerchant
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

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'product_id' => 'required|string|min:0|max:17|unique:products',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'merchant_id' =>'required|integer',
            'category_id' =>'required|integer',
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
                'product_id' => $req['product_id'],
                'name' => $req['name'],
                'description' => $req['description'],
                'price' => $req['price'],
                'second_price' => $req['second_price'],
                'note' => $req['note'],
                'type' => $req['type'],
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'merchant_id' => $req['merchant_id'],
                'category_id' => $req['category_id'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Product::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Product::where(['product_id' => $req['product_id']])->first()
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
            'product_id' => 'required|string|min:0|max:17',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'merchant_id' =>'required|integer',
            'category_id' =>'required|integer',
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
                'description' => $req['description'],
                'price' => $req['price'],
                'second_price' => $req['second_price'],
                'note' => $req['note'],
                'type' => $req['type'],
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'category_id' => $req['category_id'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Product::where(['product_id' => $req['product_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Product::where(['product_id' => $req['product_id']])->first()
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
            'product_id' => 'required|string|min:0|max:17',
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
            $data = Product::where(['product_id' => $req['product_id']])->first();

            if ($data)
            {
                ProductImage::where(['product_id' => $data->id])->delete();
                Product::where(['id' => $data->id])->delete();

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
