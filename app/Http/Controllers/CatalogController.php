<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Catalog;
use App\Shop;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Category;
use App\ProductToping;

class CatalogController extends Controller
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
            $shID = $req['shop_id'];
            $status = $req['status'];

            $stt = $status ? ['products.status' => $status] : [];
            if ($shID) {
                $data = Catalog::limit($limit)->offset($offset)->where(['shop_id' => $shID])->get();
            } else {
                $data = Catalog::limit($limit)->offset($offset)->get();
            }
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $catalog = $dump[$i];
                    $stt = $status ? ['status' => $status] : [];
                    $shop = Shop::where(['id' => $catalog['shop_id']])->first();
                    $product = Product::GetByOnlyID($catalog['product_id']);
                    $detailProduct = ProductDetail::where(array_merge(['product_id' => $product->id], $stt))->orderBy('id', 'desc')->get();
                    $detailImage = ProductImage::where(['product_id' => $product->id])->orderBy('id', 'desc')->get();
                    $detailToping = ProductToping::GetAll(1000, 0, $product->id, $stt);
                    $payload = [
                        'catalog' => $catalog,
                        'shop' => $shop,
                        'product' => $product,
                        'details' => $detailProduct,
                        'images' => $detailImage,
                        'topings' => $detailToping,
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

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'shop_id' => 'required|integer',
            'product_id' => 'required|integer'
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
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'shop_id' => $req['shop_id'],
                'product_id' => $req['product_id'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $check = Catalog::where(['shop_id' => $req['shop_id'], 'product_id' => $req['product_id']])->first();

            if ($check) {
                $response = [
                    'message' => 'data already choosed',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            } else {
                $data = Catalog::insert($payload);

                if ($data)
                {
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
                        'message' => 'failed to save',
                        'status' => 'failed',
                        'code' => '201',
                        'data' => []
                    ];
                }
            }
        }

        return response()->json($response, 200);
    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|integer',
            'is_pinned' => 'required|boolean',
            'is_available' => 'required|boolean',
            'status' => 'required|string',
            'shop_id' => 'required|integer',
            'product_id' => 'required|integer'
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
                'is_pinned' => $req['is_pinned'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'shop_id' => $req['shop_id'],
                'product_id' => $req['product_id'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Catalog::where(['id' => $req['id']])->update($payload);

            if ($data)
            {
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
            'id' => 'required|integer',
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
            $data = Catalog::where(['id' => $req['id']])->delete();

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
