<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\OrderItem;
use App\Order;
use App\Table;
use App\Customer;
use App\Address;
use App\Shipment;
use App\Payment;
use App\Shop;
use App\User;
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
            'order_id' => 'string',
            'shop_id' => 'integer',
            'user_id' => 'integer'
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
            
            $odID = $req['order_id'];
            $uID = $req['user_id'];
            $shID = $req['shop_id'];

            if ($odID) {
                $order = Order::where(['order_id' => $odID])->first();
                $data = OrderItem::where(['order_id' => $order->id])
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
            } else if ($uID) {
                $data = OrderItem::where(['created_by' => $uID])
                        ->limit($limit)
                        ->offset($offset)
                        ->orderBy('id', 'desc')
                        ->get();
            } else if ($shID) {
                $order = Order::where(['shop_id' => $shID])->first();
                $data = OrderItem::where(['order_id' => $order->id])
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
            } else {
                $data = [];
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

    public function getAllTasks(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'order_id' => 'string',
            'shop_id' => 'integer',
            'user_id' => 'integer'
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
            
            $odID = $req['order_id'];
            $uID = $req['user_id'];
            $shID = $req['shop_id'];

            if ($odID) {
                $order = Order::where(['order_id' => $odID])->first();
                $data = OrderItem::where(['order_id' => $order->id])
                        ->where('status', '!=', 'done')
                        ->limit($limit)
                        ->offset($offset)
                        ->orderBy('id', 'desc')
                        ->get();
            } else if ($uID) {
                $data = OrderItem::where(['assigned_id' => $uID])
                        ->where('status', '!=', 'done')
                        ->limit($limit)
                        ->offset($offset)
                        ->orderBy('id', 'desc')
                        ->get();
            } else if ($shID) {
                $data = OrderItem::where(['shop_id' => $shID])
                        ->where('status', '=', 'waiting')
                        ->limit($limit)
                        ->offset($offset)
                        ->orderBy('id', 'desc')
                        ->get();
            } else {
                $data = [];
            }
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $orderItems = $dump[$i];
                    $order = Order::where(['id' => $orderItems['order_id']])->first();
                    $user = User::where('id', $orderItems['assigned_id'])->first();
                    $employee = null;

                    if ($user) {
                        $employee = Employee::GetById($user->owner_id);//Employee::where('id', $user->owner_id)->first();
                    }

                    $payload = [
                        'order' => $order,
                        'detail' => $orderItems,
                        'user' => $user,
                        'employee' => $employee
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

    public function getAllHistory(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'user_id' => 'integer'
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
            $uID = $req['user_id'];

            $data = OrderItem::where(['assigned_id' => $uID])
                ->where('status', 'done')
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
                    $user = User::where('id', $orderItems['assigned_id'])->first();
                    $employee = null;

                    if ($user) {
                        $employee = Employee::GetById($user->owner_id);//Employee::where('id', $user->owner_id)->first();
                    }

                    $payload = [
                        'order' => $order,
                        'detail' => $orderItems,
                        'user' => $user,
                        'employee' => $employee
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

    public function getAllByType(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'shop_id' => 'integer',
            'type' => 'string'
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
            $type = $req['type'];

            $data = OrderItem::where(['shop_id' => $shID])
                ->where('status', $type)
                ->limit($limit)
                ->offset($offset)
                ->orderBy('updated_at', 'desc')
                ->get();
            
            if ($data) 
            {
                $newPayload = array();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $orderItems = $dump[$i];
                    $order = Order::where(['id' => $orderItems['order_id']])->first();
                    $user = User::where('id', $orderItems['assigned_id'])->first();
                    $employee = null;

                    if ($user) {
                        $employee = Employee::GetById($user->owner_id);//Employee::where('id', $user->owner_id)->first();
                    }

                    $payload = [
                        'order' => $order,
                        'detail' => $orderItems,
                        'user' => $user,
                        'employee' => $employee
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
            'toping_price' => 'required|integer',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'product_detail' => 'required|string',
            'order_id' => 'required|integer',
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
                'toping_price' => $req['toping_price'],
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'product_toping' => $req['product_toping'],
                'order_id' => $req['order_id'],
                'product_id' => $req['product_id'],
                'proddetail_id' => $req['proddetail_id'],
                'toping_id' => $req['toping_id'],
                'shop_id' => $req['shop_id'],
                'assigned_id' => $req['assigned_id'],
                'status' => $req['status'],
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
            'id' => 'required|integer|min:0',
            'toping_price' => 'required|integer',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'subtotal' => 'required|integer',
            'product_name' => 'required|string',
            'product_detail' => 'required|string',
            'order_id' => 'required|integer',
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
                'toping_price' => $req['toping_price'],
                'price' => $req['price'],
                'quantity' => $req['quantity'],
                'subtotal' => $req['subtotal'],
                'product_name' => $req['product_name'],
                'product_detail' => $req['product_detail'],
                'product_toping' => $req['product_toping'],
                'order_id' => $req['order_id'],
                'product_id' => $req['product_id'],
                'proddetail_id' => $req['proddetail_id'],
                'toping_id' => $req['toping_id'],
                'shop_id' => $req['shop_id'],
                'assigned_id' => Auth()->user()->id,
                'status' => $req['status'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = OrderItem::where(['id' => $req['id']])->update($payload);

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
            'id' => 'required|string|min:0|max:6',
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
            $data = OrderItem::where(['id' => $req['id']])->delete();

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
