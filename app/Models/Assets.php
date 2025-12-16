<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assets extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'asset_no',
        'description',
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
        'user_id',
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'end_date' => 'date',
        'base_price' => 'decimal:2',
        'accumulation_last_year' => 'decimal:2',
        'ending_book_value_last_year' => 'decimal:2',
        'dep_rate' => 'decimal:2',
        'depreciation_yearly' => 'decimal:2',
        'book_value_last_month' => 'decimal:2',
        'depreciation_accum_depr' => 'decimal:2',
        'depreciation_book_value' => 'decimal:2',
    ];

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
