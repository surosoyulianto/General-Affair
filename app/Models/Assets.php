<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'asset_number',
        'asset_name',
        'branch',
        'department',
        'type_asset',
        'brand',
        'model',
        'specification',
        'serial_number',
        'ram_capacity',
        'storage_type',
        'storage_volume',
        'os_edition',
        'os_installed',
        'purchase_date',
        'purchase_value',
        'location',
        'status',
        'description',
        'owner',
        'user_id',
    ];

    protected $casts = [
        'os_installed' => 'date',
        'purchase_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function departmentRelation()
    {
        return $this->belongsTo(Department::class, 'department', 'name');
    }

    public function branchRelation()
    {
        return $this->belongsTo(Branch::class, 'branch', 'name');
    }

    public function getAssignedUserNameAttribute()
    {
        return $this->user?->name ?? '-';
    }

    public function getDepartmentNameAttribute()
    {
        return $this->departmentRelation?->name ?? '-';
    }

    public function getBranchNameAttribute()
    {
        return $this->branchRelation?->name ?? '-';
    }
}
