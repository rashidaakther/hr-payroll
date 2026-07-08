<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emppersonalinfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'father_name',
        'mother_name',
        'height',
        'contact_number',
        'birth_date',
        'gender',
        'religion',
        'nationality',
        'national_id',
        'birth_certificate',
        'blood_group',
        'marital_status',
        'emergency_contact_name',
        'emergency_contact_address',
        'emergency_contact_number',
        'emergency_contact_relationship'
    ];

    function empofficeinfos()
    {
        return $this->belongsTo(Empofficeinfos::class, 'id', 'employee_id');
    }
    function getreligion()
    {
        return $this->belongsTo(Religion::class, 'religion', 'id');
    }
    // function getbloodgroup(){
    //     return $this->belongsTo(BloodGroup::class, 'blood_group', 'id');
    // }
    // function getmaritalstatus(){
    //     return $this->belongsTo(Maritalstatus::class, 'marital_status', 'id');
    // }
}
