<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function scopeGetAll($query, $limit, $offset, $stt)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where($stt)
        ->limit($limit)
        ->offset($offset)
        ->orderBy('id', 'desc')
        ->get();
    }

    public function scopeGetAllByID($query, $limit, $offset, $stt, $id)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where($stt)
        ->where('products.created_by', $id)
        ->limit($limit)
        ->offset($offset)
        ->orderBy('id', 'desc')
        ->get();
    }

    public function scopeGetAllStatus($query, $limit, $offset, $status)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where('products.status', $status)
        ->limit($limit)
        ->offset($offset)
        ->orderBy('id', 'desc')
        ->get();
    }

    public function scopeGetByID($query, $id)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where(['products.product_id' => $id])
        ->first();
    }

    public function scopeGetByOnlyID($query, $id)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where(['products.id' => $id])
        ->first();
    }

    public function scopeGetByIDStatus($query, $id, $status)
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
            'categories.name as ctr_name'
        )
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->where(['products.product_id' => $id, 'products.status' => $status])
        ->first();
    }
}
