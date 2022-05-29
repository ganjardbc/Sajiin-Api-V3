<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\WisheList;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Category;
use App\ProductToping;
use App\Customer;
use App\Table;

class WisheListController extends Controller
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
            $status = $req['status'];
            $limit = $req['limit'];
            $offset = $req['offset'];

            if ($uID) {
                $data = WisheList::GetAllByID($limit, $offset, $uID);
            } else {
                if ($oID) {
                    $data = WisheList::GetAllByOwnerID($limit, $offset, $oID);
                } else {
                    $data = WisheList::GetAll($limit, $offset);
                }
            }
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $product = $dump[$i];
                    $stt = $status ? ['status' => $status] : [];
                    $detailProduct = ProductDetail::where(array_merge(['product_id' => $dump[$i]['prod_id']], $stt))->orderBy('id', 'desc')->get();
                    $detailImage = ProductImage::where(['product_id' => $dump[$i]['prod_id']])->orderBy('id', 'desc')->get();
                    $detailToping = ProductToping::GetAll(1000, 0, $dump[$i]['prod_id'], $stt);
                    $detailCustomer= Customer::where(['id' => $dump[$i]['owner_id']])->first();
                    $detailTable= Table::where(['id' => $dump[$i]['owner_id']])->first();
                    $categories = Category::get();
                    $payload = [
                        'product' => $product,
                        'details' => $detailProduct,
                        'images' => $detailImage,
                        'topings' => $detailToping,
                        'categories' => $categories,
                        'customer' => $detailCustomer,
                        'table' => $detailTable
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

    public function checkWisheList(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|integer',
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
                'owner_id' => $req['owner_id'],
                'user_id' => $req['user_id'], 
                'product_id' => $req['product_id']
            ];

            $check = WisheList::where($payload)->first();

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
            'user_id' => 'required|integer',
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
                'owner_id' => $req['owner_id'],
                'user_id' => Auth()->user()->id,
                'product_id' => $req['product_id'],
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $check = WisheList::where(['owner_id' => $req['owner_id'], 'user_id' => $req['user_id'], 'product_id' => $req['product_id']])->first();

            if ($check) {
                $response = [
                    'message' => 'data already choosed',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            } else {
                $data = WisheList::insert($payload);

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
            'user_id' => 'required|integer',
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
            $data = WisheList::where(['owner_id' => $req['owner_id'], 'user_id' => $req['user_id'], 'product_id' => $req['product_id']])->delete();

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
