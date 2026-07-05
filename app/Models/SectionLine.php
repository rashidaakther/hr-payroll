<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionLine extends Model
{
    use HasFactory;

    protected $table = 'section_lines'; // আপনার সঠিক টেবিল নামটি দিন

    protected $fillable = [
        'branch_id',
        'unit_id',
        'name',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
