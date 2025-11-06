<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_number',
        'name',
        'branch',
        'type_asset',
        'system_info',
        'brand',
        'model',
        'specification',
        'serial_number',
        'purchase_date',
        'purchase_value',
        'location',
        'department',
        'status',
        'description',
        'assigned_to',
    ];

    /**
     * Relasi ke user (pengguna asset)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relasi ke department (jika nanti punya tabel departments)
     */
    public function departmentRelation()
    {
        return $this->belongsTo(Department::class, 'department', 'name');
    }

    /**
     * Relasi ke branch (jika nanti punya tabel branches)
     */
    public function branchRelation()
    {
        return $this->belongsTo(Branch::class, 'branch', 'name');
    }
}
