<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalogs';

    public function scopeGetAll($query, $limit, $offset)
    {
        return $this
        ->select(
            'products.id',
            'products.product_id',
            'products.name',
            'products.description',
            'products.note',
            'products.type',
            'products.is_pinned',
            'products.is_available',
            'products.status',
            'products.user_id',
            'categories.id as ctr_id',
            'categories.name as ctr_name',
            'shops.name as shop_name'
        )
        ->join('products', 'products.id', '=', 'catalogs.product_id')
        ->join('shops', 'shops.id', '=', 'catalogs.shop_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->limit($limit)
        ->offset($offset)
        ->get();
    }
    
    public function scopeGetAllByShopID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'products.id',
            'products.product_id',
            'products.name',
            'products.description',
            'products.note',
            'products.type',
            'products.is_pinned',
            'products.is_available',
            'products.status',
            'products.user_id',
            'categories.id as ctr_id',
            'categories.name as ctr_name',
            'shops.id as shop_id',
            'shops.name as shop_name'
        )
        ->join('products', 'products.id', '=', 'catalogs.product_id')
        ->join('shops', 'shops.id', '=', 'catalogs.shop_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where(['catalogs.shop_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->get();
    }
}
