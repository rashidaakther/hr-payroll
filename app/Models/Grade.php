<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'branch_id',
        'name',
        'basic_sly',
        'house_rent',
        'medical_allowance',
        'transportation_allowance',
        'food_allowance',
        'total_approx_sly'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
