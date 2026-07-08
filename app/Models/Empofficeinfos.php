<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empofficeinfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_name',
        'employee_name_other',
        'official_mail',
        'designation',
        'office',
        'shift',
        'unit',
        'department',
        'section_line',
        'work_group',
        'salary_type',
        'card_no',
        'joining_date',
        'grade',
        'gross',
        'second_gross',
        'manager',
        'job_location',
        'probation_period',
        'confirmation_date',
        'is_ot_payable',
        'is_masked',
        'employee_status',
        'discontinuation_date',
        'discontinuation_reason'
    ];

    function emppersonalinfos()
    {
        return $this->hasOne(Emppersonalinfos::class, 'employee_id', 'id');
    }
    function getdesignation()
    {
        return $this->belongsTo(Designation::class, 'designation', 'id');
    }
    function getoffice()
    {
        return $this->belongsTo(Branch::class, 'office', 'id');
    }
    function getunit()
    {
        return $this->belongsTo(Unit::class, 'unit', 'id');
    }
    function getshift()
    {
        return $this->belongsTo(Shift::class, 'shift', 'id');
    }
    function getdepartment()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
    function getsectionline()
    {
        return $this->belongsTo(Sectionline::class, 'section_line', 'id');
    }
    function getmanager()
    {
        return $this->belongsTo(Empofficeinfos::class, 'manager', 'id');
    }
    function getgrade()
    {
        return $this->belongsTo(Grade::class, 'grade', 'id');
    }
    function attendances()
    {
        // এখানে আপনার অ্যাটেনডেন্স টেবিলের মডেল এবং ফরেন কি দিন
        return $this->hasMany(Dailyattendance::class, 'employee_id', 'id');
    }
}
