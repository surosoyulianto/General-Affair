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
        'user_id', // sesuai tabel
    ];

    protected $casts = [
        'os_installed' => 'date',
        'purchase_date' => 'date',
    ];

    /**
     * Relasi ke user (pemilik aset)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accessor untuk nama user (fallback '-')
     */
    public function getAssignedUserNameAttribute()
    {
        return $this->user?->name ?? '-';
    }

    /**
     * Karena department hanya teks biasa
     */
    public function getDepartmentNameAttribute()
    {
        return $this->department ?? '-';
    }

    /**
     * Karena branch hanya teks biasa
     */
    public function getBranchNameAttribute()
    {
        return $this->branch ?? '-';
    }
}
