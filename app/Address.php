<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function scopeGetAllByID($query, $id, $limit, $offset)
    {
        return $this
        ->select(
            'addresses.id',
            'addresses.address_id',
            'addresses.name',
            'addresses.address',
            'addresses.type',
            'addresses.is_selected',
            'addresses.customer_id',
            'customers.customer_id as cc_id',
            'customers.name as cc_name'
        )
        ->join('customers', 'customers.id', '=', 'addresses.customer_id')
        ->where(['customers.customer_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->orderBy('addresses.id', 'desc')
        ->get();
    }

    public function scopeGetAllByAddressID($query, $id)
    {
        return $this
        ->select(
            'addresses.id',
            'addresses.address_id',
            'addresses.name',
            'addresses.address',
            'addresses.type',
            'addresses.is_selected',
            'addresses.customer_id',
            'customers.customer_id as cc_id',
            'customers.name as cc_name'
        )
        ->join('customers', 'customers.id', '=', 'addresses.customer_id')
        ->where(['addresses.address_id' => $id])
        ->first();
    }
}
