<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    public function branch(){
        return $this->hasOne(Branch::class,'id','branch_id');
    }

    public function department(){
        return $this->hasOne(Department::class,'id','department_id');
    }
}
