<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    public function scopeGetAll($query, $limit, $offset)
    {
        return $this
        ->select(
            'carts.id',
            'carts.cart_id',
            'carts.toping_price',
            'carts.price',
            'carts.discount',
            'carts.quantity',
            'carts.subtotal',
            'carts.product_image',
            'carts.product_name',
            'carts.product_detail',
            'carts.product_toping',
            'carts.promo_code',
            'carts.product_id',
            'carts.proddetail_id',
            'carts.toping_id',
            'carts.owner_id',
            'carts.created_by',
            'carts.updated_by',
            'carts.created_at',
            'carts.updated_at',
            'products.product_id as prod_id',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->limit($limit)
        ->offset($offset)
        ->orderBy('carts.id', 'desc')
        ->get();
    }

    public function scopeGetAllByUserID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'carts.id',
            'carts.cart_id',
            'carts.toping_price',
            'carts.price',
            'carts.discount',
            'carts.quantity',
            'carts.subtotal',
            'carts.product_image',
            'carts.product_name',
            'carts.product_detail',
            'carts.product_toping',
            'carts.promo_code',
            'carts.product_id',
            'carts.proddetail_id',
            'carts.toping_id',
            'carts.owner_id',
            'carts.created_by',
            'carts.updated_by',
            'carts.created_at',
            'carts.updated_at',
            'products.product_id as prod_id',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->where('carts.created_by', $id)
        ->limit($limit)
        ->offset($offset)
        ->orderBy('carts.id', 'desc')
        ->get();
    }

    public function scopeGetAllByOwnerID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'carts.id',
            'carts.cart_id',
            'carts.toping_price',
            'carts.price',
            'carts.discount',
            'carts.quantity',
            'carts.subtotal',
            'carts.product_image',
            'carts.product_name',
            'carts.product_detail',
            'carts.product_toping',
            'carts.promo_code',
            'carts.product_id',
            'carts.proddetail_id',
            'carts.toping_id',
            'carts.owner_id',
            'carts.created_by',
            'carts.updated_by',
            'carts.created_at',
            'carts.updated_at',
            'products.product_id as prod_id',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->where('carts.owner_id', $id)
        ->limit($limit)
        ->offset($offset)
        ->orderBy('carts.id', 'desc')
        ->get();
    }

    public function scopeGetCountByID($query, $id)
    {
        return $this
        ->select(
            'carts.created_at',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->where('carts.created_by', $id)
        ->count();
    }

    public function scopeGetCountByCustomerID($query, $id)
    {
        return $this
        ->select(
            'carts.created_at',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->where('carts.owner_id', $id)
        ->count();
    }

    public function scopeGetCountAll($query)
    {
        return $this
        ->select(
            'carts.created_at',
        )
        ->count();
    }
}
