<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'directorate',
        'status',
        'is_branch',
        'code',
    ];

    /**
     * Scope a query to only include departments that match the search term.
     */
    public function scopeFilter($query, $term)
    {
        // If no search term, return the query as is
        if (!$term) {
            return $query;
        }

        // Make the term lowercase for case-insensitive comparison
        $term = strtolower($term);

        // Apply filters based on specific terms
        switch ($term) {
            case 'active':
                $query->where('status', true);
                break;
            case 'inactive':
                $query->where('status', false);
                break;
            case 'branch':
                $query->where('is_branch', true);
                break;
            case 'head office':
                $query->where('is_branch', false);
                break;
            default:
                $query->where('name', 'ILIKE', '%' . $term . '%')
                    ->orWhere('code', 'ILIKE', '%' . $term . '%')
                    ->orWhere('directorate', 'ILIKE', '%' . $term . '%');
                break;
        }

        // return the modified query
        return $query;
    }


    /**
     * Get the users for the department.
     */
    public function users()
    {
        return $this->hasMany(UserDetail::class);
    }

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'department_id');
    }
}
