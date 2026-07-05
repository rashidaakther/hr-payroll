<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeshboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\SectionLineController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UnitController;

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest Routes (Jara login kora nai shudhu tara ekhane dhokbe)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('login', [AuthController::class, 'showLogin']);

    // CRITICAL FIX: Form jeno '/' url-e data POST korte pare, tar secure endpoint
    Route::post('/', [AuthController::class, 'login']);
    Route::post('login', [AuthController::class, 'login']);
});

// Secure Protected System Panel (Login chara keo dhokte parbe na)
Route::middleware(['auth'])->group(function () {

    // 1. Admin Module Pipeline (Shudhu Admin access)
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/dashboard', [DeshboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/analytics', [DeshboardController::class, 'adminAnalytics'])->name('admin.analytics');

        // prefix-e 'admin' plain string hobe, {admin} parameterized variable hobe na!
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::resource('branch', BranchController::class);
            Route::get('/admin/branch/data', [BranchController::class, 'getBranchData'])->name('branch.getBranchData');
            Route::resource('department', DepartmentController::class);
            Route::get('/admin/department/data', [DepartmentController::class, 'getDepartmentData'])->name('department.getDepartmentData');
            Route::resource('designation', DesignationController::class);
            Route::get('/admin/designation/data', [DesignationController::class, 'getDesignationData'])->name('designation.getDesignationData');
            Route::resource('grade', GradeController::class);
            Route::get('/admin/grade/data', [GradeController::class, 'getGradeData'])->name('grade.getGradeData');
            Route::resource('holiday', HolidayController::class);
            Route::get('/admin/holiday/data', [HolidayController::class, 'getHolidayData'])->name('holiday.getHolidayData');
            Route::resource('religion', ReligionController::class);
            Route::get('/admin/religion/data', [ReligionController::class, 'getReligionData'])->name('religion.getReligionData');
            Route::resource('section_line', SectionLineController::class);
            Route::get('/admin/section_line/data', [SectionLineController::class, 'getSectionLineData'])->name('section_line.getSectionLineData');
            Route::resource('shift', ShiftController::class);
            Route::get('/admin/shift/data', [ShiftController::class, 'getShiftData'])->name('shift.getShiftData');
            Route::resource('unit', UnitController::class);
            Route::get('/admin/unit/data', [UnitController::class, 'getUnitData'])->name('unit.getUnitData');
        });
    });

    // 2. Employee Module Pipeline (Shudhu Employee access)
    Route::middleware(['is_employee'])->group(function () {
        Route::get('/employee/dashboard', [DeshboardController::class, 'employeeDashboard'])->name('employee.dashboard');
        Route::get('/employee/analytics', [DeshboardController::class, 'employeeAnalytics'])->name('employee.analytics');
    });

    // Logout Route (Login thaka lagbe)
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
