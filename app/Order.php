<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function scopeGetAll($query, $limit, $offset)
    {
        return $this
        ->select(
            'orders.id',
            'orders.order_id',
            'orders.owner_id',
            'orders.delivery_fee',
            'orders.total_price',
            'orders.total_item',
            'orders.bills_price',
            'orders.change_price',
            'orders.payment_status',
            'orders.status',
            'orders.type',
            'orders.note',
            'orders.created_by',
            'orders.created_at',
            'orders.updated_by',
            'orders.updated_at',
            // 'partner_configurations.name as pc_name'
        )
        // ->join('partner_configurations', 'partner_configurations.id', '=', 'orders.config_id')
        ->limit($limit)
        ->offset($offset)
        ->get();
    }

    public function scopeGetAllByID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'orders.id',
            'orders.order_id',
            'orders.owner_id',
            'orders.delivery_fee',
            'orders.total_price',
            'orders.total_item',
            'orders.bills_price',
            'orders.change_price',
            'orders.payment_status',
            'orders.status',
            'orders.type',
            'orders.note',
            'orders.created_by',
            'orders.created_at',
            'orders.updated_by',
            'orders.updated_at',
            // 'partner_configurations.name as pc_name'
        )
        // ->join('partner_configurations', 'partner_configurations.id', '=', 'orders.config_id')
        ->where(['orders.created_by' => $id])
        ->limit($limit)
        ->offset($offset)
        ->get();
    }

    public function scopeGetCountAll($query)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where('orders.status', '!=', 'canceled')
        ->where('orders.status', '!=', 'done')
        ->count();
    }

    public function scopeGetCountByID($query, $id)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where('orders.created_by', '=', $id)
        ->where('orders.status', '!=', 'canceled')
        ->where('orders.status', '!=', 'done')
        ->count();
    }

    public function scopeGetCountByStatusID($query, $id, $status)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where(['orders.created_by' => $id, 'orders.status' => $status])
        ->count();
    }

    public function scopeGetCountByShopID($query, $id)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where('orders.shop_id', '=', $id)
        ->where('orders.status', '!=', 'canceled')
        ->where('orders.status', '!=', 'done')
        ->count();
    }

    public function scopeGetCountByShopStatusID($query, $id, $status)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where(['orders.shop_id' => $id, 'orders.status' => $status])
        ->count();
    }

    public function scopeGetCountCustomerAll($query, $id)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where('orders.customer_id', '=', $id)
        ->where('orders.status', '!=', 'canceled')
        ->where('orders.status', '!=', 'done')
        ->count();
    }

    public function scopeGetCountCustomerByID($query, $id)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where('orders.customer_id', '=', $id)
        ->where('orders.status', '!=', 'canceled')
        ->where('orders.status', '!=', 'done')
        ->count();
    }

    public function scopeGetCountCustomerByStatusID($query, $id, $status)
    {
        return $this
        ->select(
            'orders.id'
        )
        ->where(['orders.customer_id' => $id, 'orders.status' => $status])
        ->count();
    }
}
