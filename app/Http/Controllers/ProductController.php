<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Category;
use App\ProductToping;
use App\Shop;

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
            'status' => 'string',
            'shop_id' => 'integer'
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
            $sID = $req['shop_id'];
            $status = $req['status'];
            $limit = $req['limit'];
            $offset = $req['offset'];

            $stt = $status ? ['status' => $status] : [];
            if ($sID) {
                $shop = Shop::where('id', $sID)->first();
                $newStt = array_merge($stt, ['user_id' => $shop['user_id']]);
                $data = Product::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            } else {
                $newStt = array_merge($stt, ['user_id' => Auth()->user()->id]);
                $data = Product::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            }
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $product = $dump[$i];
                    $stt = $status ? ['status' => $status] : [];
                    $detailProduct = ProductDetail::where(array_merge(['product_id' => $dump[$i]['id']], $stt))->orderBy('id', 'desc')->get();
                    $detailImage = ProductImage::where(['product_id' => $dump[$i]['id']])->orderBy('id', 'desc')->get();
                    $detailToping = ProductToping::GetAll(1000, 0, $dump[$i]['id'], $stt);
                    $categories = Category::get();
                    $payload = [
                        'product' => $product,
                        'details' => $detailProduct,
                        'images' => $detailImage,
                        'topings' => $detailToping,
                        'categories' => $categories
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

                $detailProduct = ProductDetail::where(['product_id' => $dump['id']])->orderBy('id', 'desc')->get();
                $detailImage = ProductImage::where(['product_id' => $dump['id']])->orderBy('id', 'desc')->get();
                $detailToping = ProductToping::GetAll(1000, 0, $dump['id'], []);
                $categories = Category::get();

                $newPayload = [
                    'product' => $product,
                    'details' => $detailProduct,
                    'images' => $detailImage,
                    'topings' => $detailToping,
                    'categories' => $categories
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
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'category_id' => 'required|integer'
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
                'note' => $req['note'],
                'type' => $req['type'],
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'category_id' => $req['category_id'],
                'user_id' => Auth()->user()->id,
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
            'note' => 'max:255',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'category_id' => 'required|integer'
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
                ProductDetail::where(['product_id' => $data->id])->delete();
                ProductImage::where(['product_id' => $data->id])->delete();
                ProductToping::where(['product_id' => $data->id])->delete();
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
