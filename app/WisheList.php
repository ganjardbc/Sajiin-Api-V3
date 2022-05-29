<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WisheList extends Model
{
    protected $table = 'wishe_lists';

    public function scopeGetAll($query, $limit, $offset)
    {
        return $this
        ->select(
            'wishe_lists.id',
            'wishe_lists.owner_id',
            'wishe_lists.user_id as user_id',
            'wishe_lists.product_id as prod_id',
            'products.product_id',
            'products.name',
            'products.description',
            'products.note',
            'products.type',
            'products.is_pinned',
            'products.is_available',
            'products.status',
            'users.username',
            'users.name as user_name',
            Db::raw('(select image from product_images where product_images.product_id=wishe_lists.product_id limit 1) as prod_image')
        )
        ->join('products', 'products.id', '=', 'wishe_lists.product_id')
        ->join('users', 'users.id', '=', 'wishe_lists.user_id')
        ->limit($limit)
        ->offset($offset)
        ->orderBy('wishe_lists.id', 'desc')
        ->get();
    }

    public function scopeGetAllByID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'wishe_lists.id',
            'wishe_lists.owner_id',
            'wishe_lists.user_id as user_id',
            'wishe_lists.product_id as prod_id',
            'products.product_id',
            'products.name',
            'products.description',
            'products.note',
            'products.type',
            'products.is_pinned',
            'products.is_available',
            'products.status',
            'users.username',
            'users.name as user_name',
            Db::raw('(select image from product_images where product_images.product_id=wishe_lists.product_id limit 1) as prod_image')
        )
        ->join('products', 'products.id', '=', 'wishe_lists.product_id')
        ->join('users', 'users.id', '=', 'wishe_lists.user_id')
        ->where(['wishe_lists.user_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->orderBy('wishe_lists.id', 'desc')
        ->get();
    }

    public function scopeGetAllByOwnerID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'wishe_lists.id',
            'wishe_lists.owner_id',
            'wishe_lists.user_id as user_id',
            'wishe_lists.product_id as prod_id',
            'products.product_id',
            'products.name',
            'products.description',
            'products.note',
            'products.type',
            'products.is_pinned',
            'products.is_available',
            'products.status',
            'users.username',
            'users.name as user_name',
            Db::raw('(select image from product_images where product_images.product_id=wishe_lists.product_id limit 1) as prod_image')
        )
        ->join('products', 'products.id', '=', 'wishe_lists.product_id')
        ->join('users', 'users.id', '=', 'wishe_lists.user_id')
        ->where(['wishe_lists.owner_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->orderBy('wishe_lists.id', 'desc')
        ->get();
    }
}
