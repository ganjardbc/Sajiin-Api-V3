<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    public function scopeGetAll($query, $limit, $offset)
    {
        return $this
        ->select(
            'role_permissions.id',
            'role_permissions.role_id as role_id',
            'role_permissions.permission_id as permission_id',
            'roles.role_id as main_role_id',
            'roles.role_name',
            'roles.description as role_description',
            'roles.status as role_status',
            'permissions.permission_id as main_permission_id',
            'permissions.name as permission_name',
            'permissions.description as permission_description',
            'permissions.status as permission_status'
        )
        ->join('roles', 'roles.id', '=', 'role_permissions.role_id')
        ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->limit($limit)
        ->offset($offset)
        ->orderBy('role_permissions.id', 'desc')
        ->get();
    }

    public function scopeGetAllByID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'role_permissions.id',
            'role_permissions.role_id as role_id',
            'role_permissions.permission_id as permission_id',
            'roles.role_id as main_role_id',
            'roles.role_name',
            'roles.description as role_description',
            'roles.status as role_status',
            'permissions.permission_id as main_permission_id',
            'permissions.name as permission_name',
            'permissions.description as permission_description',
            'permissions.status as permission_status'
        )
        ->join('roles', 'roles.id', '=', 'role_permissions.role_id')
        ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->where(['role_permissions.role_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->orderBy('role_permissions.id', 'desc')
        ->get();
    }

    public function scopeGetAllSmallByID($query, $limit, $offset, $id)
    {
        return $this
        ->select(
            'role_permissions.id',
            'role_permissions.role_id',
            'role_permissions.permission_id',
            'roles.role_name',
            'permissions.name as permission_name'
        )
        ->join('roles', 'roles.id', '=', 'role_permissions.role_id')
        ->join('permissions', 'permissions.id', '=', 'role_permissions.permission_id')
        ->where(['role_permissions.role_id' => $id])
        ->limit($limit)
        ->offset($offset)
        ->orderBy('role_permissions.id', 'desc')
        ->get();
    }
}
