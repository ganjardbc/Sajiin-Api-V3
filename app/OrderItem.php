<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    public function scopeGetByOrderId($query, $id)
    {
        return $this
        ->select(
            'order_items.id',
            'order_items.toping_price',
            'order_items.price',
            'order_items.discount',
            'order_items.quantity',
            'order_items.subtotal',
            'order_items.product_name',
            'order_items.product_detail',
            'order_items.product_toping',
            'order_items.promo_code',
            'order_items.order_id',
            'order_items.product_id',
            'order_items.proddetail_id',
            'order_items.toping_id',
            'order_items.shop_id',
            'order_items.assigned_id',
            'order_items.status',
            'order_items.created_by',
            'order_items.updated_by',
            'order_items.created_at',
            'order_items.updated_at',
            'products.product_id as prod_id',
            DB::raw('(select image from product_images where product_images.product_id = order_items.product_id limit 1) as product_image')
        )
        ->join('products', 'products.id' , '=', 'order_items.product_id')
        ->where('order_items.order_id', $id)
        ->orderBy('order_items.id', 'desc')
        ->get();
    }

    public function scopeGetByAssignedId($query, $id)
    {
        return $this
        ->select(
            'order_items.id',
            'order_items.toping_price',
            'order_items.price',
            'order_items.discount',
            'order_items.quantity',
            'order_items.subtotal',
            'order_items.product_name',
            'order_items.product_detail',
            'order_items.product_toping',
            'order_items.promo_code',
            'order_items.order_id',
            'order_items.product_id',
            'order_items.proddetail_id',
            'order_items.toping_id',
            'order_items.shop_id',
            'order_items.assigned_id',
            'order_items.status',
            'order_items.created_by',
            'order_items.updated_by',
            'order_items.created_at',
            'order_items.updated_at',
            'products.product_id as prod_id',
            DB::raw('(select image from product_images where product_images.product_id = order_items.product_id limit 1) as product_image')
        )
        ->join('products', 'products.id' , '=', 'order_items.product_id')
        ->where('order_items.assigned_id', $id)
        ->where('order_items.status', '!=', 'done')
        ->orderBy('order_items.id', 'desc')
        ->get();
    }
}
