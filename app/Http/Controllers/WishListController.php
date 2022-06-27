<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\WishList;
use App\Customer;
use App\Store;
use App\StoreProduct;
use App\Product;
use App\ProductImage;
use App\Category;

class WishListController extends Controller
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
            $data = WishList::where('customer_id', $req['customer_id'])
                ->limit($limit)
                ->offset($offset)
                ->orderBy('id', 'desc')
                ->get();

            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $wishList = $dump[$i];
                    $customer = Customer::where('id', $wishList['customer_id'])->first();
                    $storeProduct = StoreProduct::where('id', $wishList['store_product_id'])->first();
                    $product = Product::where(['id' => $storeProduct['product_id']])->first();
                    $product['product_image'] = ProductImage::where(['product_id' => $product['id']])->get();
                    $storeProduct['product'] = $product;
                    $storeProduct['store'] = Store::where(['id' => $storeProduct['store_id']])->first();
                    $storeProduct['category'] = Category::where(['id' => $storeProduct['category_id']])->first();
                    $payload = [
                        'wishList' => $wishList,
                        'customer' => $customer,
                        'storeProduct' => $storeProduct
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

    public function checkWishList(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'customer_id' => 'required|integer',
            'store_product_id' => 'required|integer'
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
                'customer_id' => $req['customer_id'], 
                'store_product_id' => $req['store_product_id']
            ];

            $check = WishList::where($payload)->first();

            if ($check) {
                $response = [
                    'message' => 'data already choosed',
                    'status' => 'choosed',
                    'code' => '201',
                    'data' => $check
                ];
            } else {
                $response = [
                    'message' => 'data didnt choosed',
                    'status' => 'unchoosed',
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
            'customer_id' => 'required|integer',
            'store_product_id' => 'required|integer'
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
                'customer_id' => Auth()->user()->id,
                'store_product_id' => $req['store_product_id'],
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $check = WishList::where(['customer_id' => $req['customer_id'], 'store_product_id' => $req['store_product_id']])->first();

            if ($check) {
                $response = [
                    'message' => 'data already choosed',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            } else {
                $data = WishList::insert($payload);

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
        }

        return response()->json($response, 200);
    }
    

    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'customer_id' => 'required|integer',
            'store_product_id' => 'required|integer'
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
            $data = WishList::where(['customer_id' => $req['customer_id'], 'store_product_id' => $req['store_product_id']])->delete();

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
