<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    public function scopeGetCountByID($query, $id)
    {
        return $this
        ->select(
            'carts.created_at',
        )
        ->join('products', 'products.id' , '=', 'carts.product_id')
        ->where('carts.customer_id', $id)
        ->count();
    }
}
