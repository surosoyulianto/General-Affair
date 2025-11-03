<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // Fillable columns
    protected $fillable = [
        'name',
        'branch_code',
        'karep_code',
        'status'
    ];
}
