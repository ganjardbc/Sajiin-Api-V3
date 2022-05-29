<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
{
    protected $table = 'employee_shifts';

    public function scopeGetAll($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'employee_shifts.id as es_id',
            'shifts.id as sh_id',
            'shifts.shift_id as shift_id',
            'shifts.title as shift_title',
            'shifts.description as shift_description',
            'shifts.start_time as shift_start_time',
            'shifts.end_time as shift_end_time',
            'employees.id as emp_id',
            'employees.employee_id as employee_id',
            'employees.image as employee_image',
            'employees.name as employee_name',
            'employees.about as employee_about',
            'employees.email as employee_email',
            'employees.phone as employee_phone',
            'employees.address as employee_address',
            'employees.status as employee_status',
            'positions.title as employee_position'
        )
        ->join('shifts', 'shifts.id', '=', 'employee_shifts.shift_id')
        ->join('employees', 'employees.id', '=', 'employee_shifts.employee_id')
        ->join('positions', 'positions.id', '=', 'employees.id')
        ->where(['employee_shifts.shift_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->get();
    }
}
