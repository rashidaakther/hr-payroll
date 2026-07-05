<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // The target table in your database
    protected $table = 'branches'; 

    // Authorized fields allowed for data insertion
    protected $fillable = [
        'name',
    ];
}
