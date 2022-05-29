<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Product;
use App\ProductToping;
use App\ProductDetail;
use App\ProductImage;
use App\Benefit;
use App\Article;
use App\Shipment;
use App\Payment;
use App\Shop;
use App\Catalog;
use App\Table;
use App\Notification;
use App\Order;
use App\OrderItem;

class PublicController extends Controller
{
    public function shopByID(Request $req)
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
                $newPayload = [
                    'shop' => $data,
                    'catalogs' => $catalogs,
                    'tables' => $tables,
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

    public function category(Request $req)
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

            $shop = Shop::where('id', $sID)->first();
            $newStt = array_merge($stt, ['user_id' => $shop['user_id']]);
            $data = Category::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();

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

    public function product(Request $req)
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
            $shop = Shop::where('id', $sID)->first();
            $newStt = array_merge($stt, ['user_id' => $shop['user_id']]);
            $data = Product::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            
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

    public function productByID(Request $req)
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

    public function tables(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'status' => 'string',
            'user_id' => 'integer',
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
            $uID = $req['user_id'];
            $sID = $req['shop_id'];
            $status = $req['status'];
            $limit = $req['limit'];
            $offset = $req['offset'];
            $stt = $status ? ['status' => $status] : [];

            if ($uID) 
            {
                $data = Table::where($stt)->where(['created_by' => $uID])->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            } 
            else if ($sID) {
                $data = Table::where($stt)->where(['shop_id' => $sID])->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            }
            else 
            {
                $data = Table::where($stt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            }

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

    public function payments(Request $req)
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
                $data = Payment::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            } else {
                $newStt = array_merge($stt, ['user_id' => Auth()->user()->id]);
                $data = Payment::where($newStt)->limit($limit)->offset($offset)->orderBy('id', 'desc')->get();
            }
            
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

    public function createOrder(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order' => 'required',
            'details' => 'required',
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
            $payloadOrder = $req['order'];
            $payloadOrder['created_by'] = '';
            $payloadOrder['created_at'] = date('Y-m-d H:i:s');
            $order = Order::insert($payloadOrder);
            if ($order) 
            {
                $dataOrder = Order::where(['order_id' => $payloadOrder['order_id']])->first();

                $newPayloadItems = [];
                $payloadItems = $req['details'];

                $dump = $payloadItems;

                for ($i=0; $i < count($dump); $i++) { 
                    if ($dump[$i]['cart_id'] != null) {
                        $dump[$i]['order_id'] = $dataOrder['id'];
                        unset($dump[$i]['cart_id']);
                        unset($dump[$i]['disableButton']);
                        unset($dump[$i]['disableSelect']);
                        unset($dump[$i]['owner_id']);
                    }
                    array_push($newPayloadItems, $dump[$i]);
                }

                $item = OrderItem::insert($newPayloadItems);

                if ($item) 
                {
                    $dataItem = OrderItem::where(['order_id' => $dataOrder['id']])->get();

                    $req['order'] = $dataOrder;
                    $req['details'] = $dataItem;
                    
                    $payloadResponse = [
                        'order' => $req['order'],
                        'details' => $req['details'],
                        'customer' => $req['customer'],
                        'address' => $req['address'],
                        'shipment' => $req['shipment'],
                        'payment' => $req['payment'],
                        'config' => $req['config']
                    ];

                    $response = [
                        'message' => 'proceed success',
                        'status' => 'ok',
                        'code' => '201',
                        'data' => $payloadResponse
                    ];
                } 
                else 
                {
                    $response = [
                        'message' => 'failed to save order item',
                        'status' => 'failed',
                        'code' => '201',
                        'data' => []
                    ];
                }
            } 
            else 
            {
                $response = [
                    'message' => 'failed to save order',
                    'status' => 'failed',
                    'code' => '201',
                    'data' => []
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function sendNotif(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'notification_id' => 'required|string|min:0|max:17|unique:notifications',
            'title' => 'required|string',
            'status' => 'required|string',
            'is_read' => 'required|boolean',
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
            $payload = [
                'notification_id' => $req['notification_id'],
                'title' => $req['title'],
                'subtitle' => $req['subtitle'],
                'link' => $req['link'],
                'status' => $req['status'],
                'is_read' => $req['is_read'],
                'user_id' => $req['owner_id'],
                'created_by' => '',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Notification::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Notification::where(['notification_id' => $req['notification_id']])->first()
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
}
