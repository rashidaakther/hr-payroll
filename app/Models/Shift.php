<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'start_at',
        'break_start_at',
        'break_end_at',
        'end_at',
        'total_hours',
        'general_ot_start_at',
        'general_ot_end_at',
        'extra_ot_start_at',
        'extra_ot_end_at'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
