<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function scopeGetById($query, $id)
    {
        return $this
        ->select(
            'employees.id',
            'employees.image',
            'employees.name',
            'employees.employee_id',
            'employees.position_id',
            'employees.shop_id',
            'employees.created_by',
            'employees.updated_by',
            'employees.created_at',
            'employees.updated_at',
            'positions.title as position_name',
            'shops.name as shope_name'
        )
        ->join('positions', 'positions.id' , '=', 'employees.position_id')
        ->join('shops', 'shops.id' , '=', 'employees.shop_id')
        ->where('employees.id', $id)
        ->first();
    }
}
