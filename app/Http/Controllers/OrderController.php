<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\Order;
use App\OrderItem;
use App\StoreTable;
use App\Customer;
use App\Address;
use App\Shipment;
use App\Payment;
use App\Store;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getDashboard(Request $req)
    {
        $validator = Validator::make($req->all(), [
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
            $shID = $req['store_id'];
            $data = Order::select([
                            DB::raw('DATE(created_at) AS date'),
                            DB::raw('COUNT(id) AS count')
                        ])
                        ->where(['store_id' => $shID])
                        ->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
                        ->groupBy('date')
                        ->orderBy('date', 'ASC')
                        ->get();
            
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

    // START GET DATA
    public function getAll(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'store_id' => 'required|integer',
            'status' => 'string',
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
            $data = Order::where($newStt)
                ->limit($limit)
                ->offset($offset)
                ->orderBy('id', 'desc')
                ->get();
            
            if ($data) 
            {
                $newPayload = array();

                $limit = $req['limit'];
                $offset = $req['offset'];

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $order = $dump[$i];
                    $orderItems = OrderItem::where(['order_id' => $dump[$i]['id']])->get();
                    $table = StoreTable::where(['id' => $dump[$i]['table_id']])->first();
                    $customer = Customer::where(['id' => $dump[$i]['customer_id']])->first();
                    $address = Address::where(['id' => $dump[$i]['address_id']])->first();
                    $shipment = Shipment::where(['id' => $dump[$i]['shipment_id']])->first();
                    $payment = Payment::where(['id' => $dump[$i]['payment_id']])->first();
                    $store = Store::where(['id' => $dump[$i]['store_id']])->first();

                    $payload = [
                        'order' => $order,
                        'orderItems' => $orderItems,
                        'table' => $table,
                        'customer' => $customer,
                        'address' => $address,
                        'shipment' => $shipment,
                        'payment' => $payment,
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
            'order_id' => 'required|string'
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
            $order_id = $req['order_id'];
            $data = Order::where(['order_id' => $order_id])->first();
            
            if ($data) 
            {
                $dump = json_decode($data, true);

                $order = $dump;
                $orderItems = OrderItem::where(['order_id' => $dump['id']])->get();
                $table = StoreTable::where(['id' => $dump['table_id']])->first();
                $customer = Customer::where(['id' => $dump['customer_id']])->first();
                $address = Address::where(['id' => $dump['address_id']])->first();
                $shipment = Shipment::where(['id' => $dump['shipment_id']])->first();
                $payment = Payment::where(['id' => $dump['payment_id']])->first();
                $store = Store::where(['id' => $dump['store_id']])->first();

                $payload = [
                    'order' => $order,
                    'orderItems' => $orderItems,
                    'table' => $table,
                    'customer' => $customer,
                    'address' => $address,
                    'shipment' => $shipment,
                    'payment' => $payment,
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
    // END GET DATA

    // START COUNTING
    public function getCountByID(Request $req)
    {
        $response = [];

        $id = Auth()->user()->id;
        $data = Order::GetCountByID($id);
        
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

        return response()->json($response, 200);
    }

    public function getCountByStoreID(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'store_id' => 'required|integer'
        ]);

        $response = [];

        $shID = $req['store_id'];
        $data = [
            'all' => Order::GetCountByShopID($shID),
            'unconfirmed' => Order::GetCountByShopStatusID($shID, 'unconfirmed'),
            'confirmed' => Order::GetCountByShopStatusID($shID, 'confirmed'),
            'cooking' => Order::GetCountByShopStatusID($shID, 'cooking'),
            'packing' => Order::GetCountByShopStatusID($shID, 'packing'),
            'shipping' => Order::GetCountByShopStatusID($shID, 'shipping'),
            'done' => Order::GetCountByShopStatusID($shID, 'done'),
            'canceled' => Order::GetCountByShopStatusID($shID, 'canceled')
        ];
        
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

        return response()->json($response, 200);
    }

    public function getCountCustomerByID(Request $req)
    {
        $validator = Validator::make($req->all(), [
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
            $id = $req['owner_id'];
            $data = [
                'all' => Order::GetCountCustomerByID($id),
                'unconfirmed' => Order::GetCountCustomerByStatusID($id, 'unconfirmed'),
                'confirmed' => Order::GetCountCustomerByStatusID($id, 'confirmed'),
                'cooking' => Order::GetCountCustomerByStatusID($id, 'cooking'),
                'packing' => Order::GetCountCustomerByStatusID($id, 'packing'),
                'shipping' => Order::GetCountCustomerByStatusID($id, 'shipping'),
                'done' => Order::GetCountCustomerByStatusID($id, 'done'),
                'canceled' => Order::GetCountCustomerByStatusID($id, 'canceled')
            ];
            
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
    // END COUNTING

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order_id' => 'required|string|min:0|max:17|unique:orders',
            'delivery_price' => 'required|integer|min:0',
            'total_price' => 'required|integer|min:0',
            'total_item' => 'required|integer|min:0',
            'bills_price' => 'required|integer|min:0',
            'change_price' => 'required|integer|min:0',
            'payment_status' => 'required|boolean',
            'status' => 'required|string',
            'type' => 'required|string',
            'note' => 'max:255',
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
                'order_id' => $req['order_id'],
                'delivery_price' => $req['delivery_price'],
                'total_price' => $req['total_price'],
                'total_item' => $req['total_item'],
                'bills_price' => $req['bills_price'],
                'change_price' => $req['change_price'],
                'payment_status' => $req['payment_status'],
                'store_name' => $req['store_name'],
                'table_name' => $req['table_name'],
                'customer_name' => $req['customer_name'],
                'payment_name' => $req['payment_name'],
                'shipment_name' => $req['shipment_name'],
                'proof_of_payment' => $req['proof_of_payment'],
                'status' => $req['status'],
                'type' => $req['type'],
                'note' => $req['note'],
                'store_id' => $req['store_id'],
                'table_id' => $req['table_id'],
                'customer_id' => $req['customer_id'],
                'address_id' => $req['address_id'],
                'shipment_id' => $req['shipment_id'],
                'payment_id' => $req['payment_id'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Order::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Order::where(['order_id' => $req['order_id']])->first()
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

    public function postAdmin(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order' => 'required',
            'orderItems' => 'required'
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
            $payloadOrder['created_by'] = Auth()->user()->id;
            $payloadOrder['created_at'] = date('Y-m-d H:i:s');

            $order = Order::insert($payloadOrder);
            if ($order) 
            {
                $dataOrder = Order::where(['order_id' => $payloadOrder['order_id']])->first();
                $payloadTable = $dataOrder->table_id;

                if ($payloadTable) {
                    StoreTable::where(['id' => $payloadTable])->update(['status' => 'inactive']);
                }

                $newPayloadItems = [];
                $payloadItems = $req['orderItems'];

                $dump = $payloadItems;

                for ($i=0; $i < count($dump); $i++) { 
                    $dump[$i]['order_id'] = $dataOrder['id'];
                    array_push($newPayloadItems, $dump[$i]);
                }

                $item = OrderItem::insert($newPayloadItems);

                if ($item) 
                {
                    $dataItem = OrderItem::where(['order_id' => $dataOrder['id']])->get();

                    $req['order'] = $dataOrder;
                    $req['orderItems'] = $dataItem;
                    
                    $payloadResponse = [
                        'order' => $req['order'],
                        'orderItems' => $req['orderItems'],
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

    public function postCustomer(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order' => 'required',
            'orderItems' => 'required',
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
            $payloadOrder['created_by'] = Auth()->user()->id;
            $payloadOrder['created_at'] = date('Y-m-d H:i:s');
            $order = Order::insert($payloadOrder);
            if ($order) 
            {
                $dataOrder = Order::where(['order_id' => $payloadOrder['order_id']])->first();
                $payloadTable = $dataOrder->table_id;

                if ($payloadTable) {
                    StoreTable::where(['id' => $payloadTable])->update(['status' => 'inactive']);
                }

                $newPayloadItems = [];
                $payloadItems = $req['orderItems'];

                $dump = $payloadItems;

                for ($i=0; $i < count($dump); $i++) { 
                    if ($dump[$i]['cart_id'] != null) {
                        Cart::where(['cart_id' => $dump[$i]['cart_id']])->delete();

                        $dump[$i]['order_id'] = $dataOrder['id'];
                        unset($dump[$i]['cart_id']);
                    }
                    array_push($newPayloadItems, $dump[$i]);
                }

                $item = OrderItem::insert($newPayloadItems);

                if ($item) 
                {
                    $dataItem = OrderItem::where(['order_id' => $dataOrder['id']])->get();

                    $req['order'] = $dataOrder;
                    $req['orderItems'] = $dataItem;
                    
                    $payloadResponse = [
                        'order' => $req['order'],
                        'orderItems' => $req['orderItems'],
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

    public function postOrderStatus(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order_id' => 'required|string|min:0|max:17',
            'status' => 'required|string',
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
                'status' => $req['status']
            ];

            $data = Order::where(['order_id' => $req['order_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Order::where(['order_id' => $req['order_id']])->first()
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

    public function postOrderPaymentStatus(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'order_id' => 'required|string|min:0|max:17',
            'payment_status' => 'required|boolean',
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
                'payment_status' => $req['payment_status']
            ];

            $data = Order::where(['order_id' => $req['order_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Order::where(['order_id' => $req['order_id']])->first()
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
            'order_id' => 'required|string|min:0|max:17',
            'delivery_price' => 'required|integer|min:0',
            'total_price' => 'required|integer|min:0',
            'total_item' => 'required|integer|min:0',
            'bills_price' => 'required|integer|min:0',
            'change_price' => 'required|integer|min:0',
            'payment_status' => 'required|boolean',
            'status' => 'required|string',
            'type' => 'required|string',
            'note' => 'max:255'
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
                'delivery_price' => $req['delivery_price'],
                'total_price' => $req['total_price'],
                'total_item' => $req['total_item'],
                'bills_price' => $req['bills_price'],
                'change_price' => $req['change_price'],
                'payment_status' => $req['payment_status'],
                'store_name' => $req['store_name'],
                'table_name' => $req['table_name'],
                'customer_name' => $req['customer_name'],
                'payment_name' => $req['payment_name'],
                'shipment_name' => $req['shipment_name'],
                'proof_of_payment' => $req['proof_of_payment'],
                'status' => $req['status'],
                'type' => $req['type'],
                'note' => $req['note'],
                'store_id' => $req['store_id'],
                'table_id' => $req['table_id'],
                'customer_id' => $req['customer_id'],
                'address_id' => $req['address_id'],
                'shipment_id' => $req['shipment_id'],
                'payment_id' => $req['payment_id'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Order::where(['order_id' => $req['order_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Order::where(['order_id' => $req['order_id']])->first()
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
            'order_id' => 'required|string|min:0|max:17',
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
            $data = Order::where(['order_id' => $req['order_id']])->first();
            if ($data)
            {
                OrderItem::where(['order_id' => $data['id']])->delete();
                Order::where(['order_id' => $data['order_id']])->delete();
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
