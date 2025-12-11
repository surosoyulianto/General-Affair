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
        'branch',            // kolom lama (text)
        'department',        // kolom lama (text)
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
        'user_id',
        'branch_id',         // kolom baru FK
        'department_id',     // kolom baru FK
        // Kolom baru untuk upload Excel
        'asset_no',
        'dept',
        'acquisition_date',
        'end_date',
        'voucher_aqc',
        'base_price',
        'accumulation_last_year',
        'ending_book_value_last_year',
        'dep_rate',
        'depreciation_yearly',
        'book_value_last_month',
        'depreciation_accum_depr',
        'depreciation_book_value',
    ];

    protected $casts = [
        'os_installed'  => 'date',
        'purchase_date' => 'date',
    ];

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi branch baru (FK)
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    /**
     * Relasi department baru (FK)
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Accessor Fallback:
     * Jika branch_id ada → ambil relasi
     * Jika tidak → pakai kolom lama 'branch'
     */
    public function getBranchNameAttribute()
    {
        return $this->branch->name ?? $this->branch ?? '-';
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department->name ?? $this->department ?? '-';
    }

    public function getAssignedUserNameAttribute()
    {
        return $this->user->name ?? '-';
    }
}
