<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    public function scopeGetAll($query, $limit, $offset, $stt)
    {
        # code...
        return $this
        ->select(
            'tables.id',
            'tables.table_id',
            'tables.code',
            'tables.name',
            'tables.code',
            'tables.description',
            'tables.status',
            'shops.id as shop_id',
            'shops.shop_id as shop_uid',
            'shops.name as shop_name',
            'shops.about as shop_about'
        )
        ->join('shops', 'shops.id', '=', 'tables.shop_id')
        ->where($stt)
        ->limit($limit)
        ->offset($offset)
        ->get();
    }

    public function scopeGetAllByUserID($query, $limit, $offset, $stt, $id)
    {
        # code...
        return $this
        ->select(
            'tables.id',
            'tables.table_id',
            'tables.code',
            'tables.name',
            'tables.code',
            'tables.description',
            'tables.status',
            'shops.id as shop_id',
            'shops.shop_id as shop_uid',
            'shops.name as shop_name',
            'shops.about as shop_about'
        )
        ->join('shops', 'shops.id', '=', 'tables.shop_id')
        ->where($stt)
        ->where('tables.created_by', $id)
        ->limit($limit)
        ->offset($offset)
        ->get();
    }
}
