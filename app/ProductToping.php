<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductToping extends Model
{
    protected $table = 'product_topings';

    public function scopeGetAll($query, $limit, $offset, $id, $stt)
    {
        return $this->select(
            'product_topings.id',
            'topings.toping_id',
            'topings.name',
            'topings.description',
            'topings.price',
            'topings.status',
            'product_topings.created_at',
            'product_topings.updated_at'
        )
        ->join('topings', 'topings.id', '=', 'product_topings.toping_id')
        ->where(array_merge(['product_id' => $id], $stt))
        ->limit($limit)
        ->offset($offset)
        ->get();
    }
}
