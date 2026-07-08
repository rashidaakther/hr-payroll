<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyattendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', 
        'year_id', 
        'month_id', 
        'date', 
        'in_time', 
        'out_time', 
        'general_working_hour', 
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Empofficeinfos::class, 'employee_id', 'id');
    }
}
