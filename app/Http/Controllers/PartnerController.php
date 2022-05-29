<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Partner;
use App\PartnerConfiguration;

class PartnerController extends Controller
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
            $data = Partner::limit($limit)->offset($offset)->get();
            
            if ($data) 
            {
                $newPayload = array();

                $limit = $req['limit'];
                $offset = $req['offset'];
                $data = Partner::limit($limit)->offset($offset)->orderBy('id', 'desc')->get();

                $dump = json_decode($data, true);

                for ($i=0; $i < count($dump); $i++) { 
                    $partner = $dump[$i];
                    $configuration = PartnerConfiguration::where(['partner_id' => $dump[$i]['id']])->orderBy('id', 'desc')->get();
                    $payload = [
                        'partner' => $partner,
                        'configurations' => $configuration
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
            'partner_id' => 'required|string|min:0|max:6',
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
            $partner_id = $req['partner_id'];
            $data = Partner::where(['partner_id' => $partner_id])->first();

            $dump = json_decode($data, true);
            $product = $dump;

            $configuration = PartnerConfiguration::where(['partner_id' => $dump['id']])->get();
            $newPayload = [
                'partner' => $data,
                'configurations' => $configuration
            ];
            
            if ($data) 
            {
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
            'partner_id' => 'required|string|min:0|max:6|unique:partners',
            'image' => 'string',
            'name' => 'required|string',
            'percentage' => 'required',
            'amount' => 'required',
            'is_available' => 'required|boolean',
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
                'partner_id' => $req['partner_id'],
                'image' => $req['image'],
                'name' => $req['name'],
                'description' => $req['description'],
                'percentage' => $req['percentage'],
                'amount' => $req['amount'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'created_by' => Auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $data = Partner::insert($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Partner::where(['partner_id' => $req['partner_id']])->first()
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
            'partner_id' => 'required|string|min:0|max:6',
            'image' => 'string',
            'name' => 'required|string',
            'percentage' => 'required',
            'amount' => 'required',
            'is_available' => 'required|boolean',
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
                'image' => $req['image'],
                'name' => $req['name'],
                'description' => $req['description'],
                'percentage' => $req['percentage'],
                'amount' => $req['amount'],
                'is_available' => $req['is_available'],
                'status' => $req['status'],
                'updated_by' => Auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $data = Partner::where(['partner_id' => $req['partner_id']])->update($payload);

            if ($data)
            {
                $response = [
                    'message' => 'proceed success',
                    'status' => 'ok',
                    'code' => '201',
                    'data' => Partner::where(['partner_id' => $req['partner_id']])->first()
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
            'partner_id' => 'required|string|min:0|max:6',
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
            $data = Partner::where(['partner_id' => $req['partner_id']])->delete();

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
