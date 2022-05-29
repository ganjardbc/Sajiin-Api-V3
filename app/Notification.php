<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function scopeGetCountAll($query, $id)
    {
        return $this
        ->select(
            'id',
        )
        ->where(['user_id' => $id, 'is_read' => 0])
        ->count();
    }
}
