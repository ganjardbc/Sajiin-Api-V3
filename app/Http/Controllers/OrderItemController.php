<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\OrderItem;
use App\Order;
use App\Customer;
use App\Address;
use App\Shipment;
use App\Payment;
use App\User;
use App\Store;
use App\Product;
use App\Employee;

class OrderItemController extends Controller
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
            'order_id' => 'required|integer',
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
            $newStt = array_merge($stt, ['order_id' => $req['order_id']]);
            $data = OrderItem::where($newStt)
                ->limit($limit)
                ->offset($offset)
                ->get();
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $orderItems = $dump[$i];
                    $order = Order::where(['id' => $orderItems['order_id']])->first();
                    $product = Product::where('id', $orderItems['product_id'])->first();
                    $store = Store::where('id', $orderItems['store_id'])->first();
                    $employee = Employee::where('id', $orderItems['employee_id'])->first();

                    $payload = [
                        'orderItems' => $orderItems,
                        'order' => $order,
                        'product' => $product,
                        'store' => $store,
                        'employee' => $employee,
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
            'order_item_id' => 'required|string',
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
            $data = OrderItem::where(['order_item_id' => $req['order_item_id']])
                ->limit($limit)
                ->offset($offset)
                ->first();
            
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

    public function getAllByStoreID(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'store_id' => 'required|integer',
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
            $newStt = array_merge($stt, ['store_id' => $req['store_id']]);
            $data = OrderItem::where($newStt)
                ->limit($limit)
                ->offset($offset)
                ->orderBy('id', 'desc')
                ->get();
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $orderItems = $dump[$i];
                    $order = Order::where(['id' => $orderItems['order_id']])->first();
                    $product = Product::where('id', $orderItems['product_id'])->first();
                    $store = Store::where('id', $orderItems['store_id'])->first();
                    $employee = Employee::where('id', $orderItems['employee_id'])->first();

                    $payload = [
                        'orderItems' => $orderItems,
                        'order' => $order,
                        'product' => $product,
                        'store' => $store,
                        'employee' => $employee,
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

    public function getAllByEmployeeID(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'employee_id' => 'required|integer',
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
            $newStt = array_merge($stt, ['employee_id' => $req['employee_id']]);
            $data = OrderItem::where($newStt)
                ->limit($limit)
                ->offset($offset)
                ->orderBy('id', 'desc')
                ->get();
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $orderItems = $dump[$i];
                    $order = Order::where(['id' => $orderItems['order_id']])->first();
                    $product = Product::where('id', $orderItems['product_id'])->first();
                    $store = Store::where('id', $orderItems['store_id'])->first();
                    $employee = Employee::where('id', $orderItems['employee_id'])->first();

                    $payload = [
                        'orderItems' => $orderItems,
                        'order' => $order,
                        'product' => $product,
                        'store' => $store,
                        'employee' => $employee,
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
            'order_item_id' => 'required|string|min:0|max:17|unique:order_items',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'discount' => 'required|integer',
            'product_name' => 'required|string',
            'status' => 'required|string',
            'order_id' => 'required|integer'
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
                'order_item_id' => $req['order_item_id'],
                'price' => $req['price'],
                'discount' => $req['discount'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_image' => $req['product_image'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'promo_code' => $req['promo_code'],
                'status' => $req['status'],
                'order_id' => $req['order_id'],
                'product_id' => $req['product_id'],
                'store_id' => $req['store_id'],
                'employee_id' => $req['employee_id'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = OrderItem::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => OrderItem::where(['order_id' => $req['order_id']])->get()
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
            'order_item_id' => 'required|string|min:0|max:17',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'discount' => 'required|integer',
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
                'price' => $req['price'],
                'discount' => $req['discount'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'promo_code' => $req['promo_code'],
                'status' => $req['status'],
                'employee_id' => $req['employee_id'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = OrderItem::where(['order_item_id' => $req['order_item_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => OrderItem::where(['order_id' => $req['order_id']])->get()
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
            'order_item_id' => 'required|string|min:0|max:17',
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
            $data = OrderItem::where(['order_item_id' => $req['order_item_id']])->delete();

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
