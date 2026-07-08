<?php

namespace App\Http\Controllers;

use App\Models\Dailyattendance;
use Illuminate\Http\Request;
use App\Models\Empofficeinfos;
use App\Models\Unit;
use App\Models\Department;
use App\Models\Sectionline;
use App\Models\Designation;
use App\Models\Setting;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendaceController extends Controller
{
    //Monthly Manual Attendance
    public function monthlyManual_index()
    {
        $employees = Empofficeinfos::with(['getdesignation'])
            ->select('id', 'employee_name', 'designation', 'shift')
            ->get();
        $years = Year::all();

        return view('attendance.monthly_manual_attendance', compact('employees', 'years'));
    }

    public function monthlyManual_getExistingAttendance(Request $request)
    {
        $attendances = DB::table('dailyattendances')
            ->where('employee_id', $request->employee_id)
            ->where('year_id', $request->year_id)
            ->where('month_id', $request->month_id)
            ->get()
            ->keyBy('date');

        $employee = Empofficeinfos::with('getshift')->find($request->employee_id);

        $shiftInfo = null;
        if ($employee && $employee->getshift) {
            $shiftInfo = [
                'start_at' => $employee->getshift->start_at ? date('H:i', strtotime($employee->getshift->start_at)) : '09:00',
                'end_at' => $employee->getshift->end_at ? date('H:i', strtotime($employee->getshift->end_at)) : '17:00'
            ];
        }
        return response()->json([
            'attendances' => $attendances,
            'shift_info' => $shiftInfo
        ]);
    }

    public function monthlyManual_saveAttendance(Request $request)
    {
        // ১. Validation
        $request->validate([
            'employee_id' => 'required',
            'attendances' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->attendances as $row) {

                if (isset($row['selected']) && $row['selected'] == "1") {

                    $generalWorkingHour = "00:00";
                    if (!empty($row['in_time']) && !empty($row['out_time'])) {


                        try {

                            $inTimeOnly = date('H:i:s', strtotime($row['in_time']));
                            $outTimeOnly = date('H:i:s', strtotime($row['out_time']));

                            $inTimeCarbon = Carbon::createFromFormat('H:i:s', $inTimeOnly);
                            $outTimeCarbon = Carbon::createFromFormat('H:i:s', $outTimeOnly);


                            if ($outTimeCarbon->lessThan($inTimeCarbon)) {
                                $outTimeCarbon->addDay();
                            }


                            $totalMinutes = $inTimeCarbon->diffInMinutes($outTimeCarbon);


                            $breakMinutes = 0;

                            $employeeOfficeInfo = Empofficeinfos::where('id', $request->employee_id)->first();


                            if ($employeeOfficeInfo && is_object($employeeOfficeInfo->getshift)) {
                                $rawBreakHours = $employeeOfficeInfo->getshift->total_break_hours;

                                if (!empty($rawBreakHours)) {
                                    if (strpos($rawBreakHours, ':') !== false) {
                                        $parts = explode(':', $rawBreakHours);
                                        $breakMinutes = ((int) $parts[0] * 60) + (int) ($parts[1] ?? 0);
                                    } else {
                                        $breakMinutes = (float) $rawBreakHours * 60;
                                    }
                                }
                            } else {

                                $breakMinutes = 0;
                            }


                            if ($totalMinutes > $breakMinutes) {
                                $totalMinutes = $totalMinutes - $breakMinutes;
                            } else {
                                $totalMinutes = 0;
                            }


                            $hours = floor($totalMinutes / 60);
                            $minutes = $totalMinutes % 60;


                            $generalWorkingHour = sprintf('%02d:%02d', $hours, $minutes);
                            // $generalWorkingHour = $totalMinutes;

                        } catch (\Exception $e) {

                            $generalWorkingHour = "00:00";
                        }
                    }

                    DB::table('dailyattendances')->updateOrInsert(
                        [
                            'employee_id' => $request->employee_id,
                            'date' => $row['date'],
                        ],
                        [
                            'year_id' => $request->year_id,
                            'month_id' => $request->month_id,
                            'in_time' => $row['in_time'],
                            'out_time' => $row['out_time'],
                            'status' => $row['status'],
                            'general_working_hour' => $generalWorkingHour,
                            'updated_at' => now(),
                        ]
                    );
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Attendance saved successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
