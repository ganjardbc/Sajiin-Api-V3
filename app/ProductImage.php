<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImage extends Model
{
    public function scopeGetImageByProductID($query, $id)
    {
        return $this
        ->select('id', 'image', 'product_id')
        ->where('product_id', $id)
        ->orderBy('id', 'desc')
        ->get();
    }
}
