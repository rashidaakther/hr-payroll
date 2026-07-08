<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Empofficeinfos;
use App\Models\Emppersonalinfos;
use App\Models\Setting;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SectionLine;
use App\Models\Grade;
use App\Models\Religion;
use App\Models\Holiday;
use App\Models\Branch;
use App\Models\Shift;
use App\Models\Unit;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function getEmployeeData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // রিলেশনশিপসহ কুয়েরি ইনিশিয়ালাইজ করা
        $query = Empofficeinfos::with(['getdesignation', 'getdepartment', 'getsectionline']);

        // লাইভ সার্চ ফিল্টারিং
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('employee_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('employee_name', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('getdesignation', function ($sub) use ($search) {
                        $sub->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('getdepartment', function ($sub) use ($search) {
                        $sub->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('getsectionline', function ($sub) use ($search) {
                        $sub->where('name', 'LIKE', '%' . $search . '%');
                    });
            });
        }

        $totalRecords = Empofficeinfos::count();

        // পেজিনেশন বা অল ডাটা হ্যান্ডলিং
        if ($perPage === 'all') {
            $employees = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $employees->count();

            // রেকর্ড সংখ্যা যদি ০ হয়
            if ($itemsCount === 0) {
                $summaryText = "Showing 0 to 0 of 0 entries";
            } else {
                $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
            }
        } else {
            $employees = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);

            // রেকর্ড সংখ্যা যদি ০ হয়
            if ($employees->total() === 0) {
                $summaryText = "Showing 0 to 0 of 0 entries";
            } else {
                $startEntry = ($employees->currentPage() - 1) * $employees->perPage() + 1;
                $endEntry   = min($startEntry + $employees->perPage() - 1, $employees->total());
                $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
            }
        }

        $htmlOutput = '';
        if ($employees->count() > 0) {
            foreach ($employees as $employee) {
                $designationName = $employee->getdesignation ? $employee->getdesignation->name : 'N/A';
                $departmentName  = $employee->getdepartment ? $employee->getdepartment->name : 'N/A';
                $sectionLineName = $employee->getsectionline ? $employee->getsectionline->name : 'N/A';
                $formattedDate   = $employee->joining_date ? date('d M, Y', strtotime($employee->joining_date)) : 'N/A';

                // ১. কোনো এনক্রিপশন ছাড়া সরাসরি নরমাল আইডি পাসিং লিংক
                $idColumn = '<a class="text-success text-decoration-none font-weight-bold" href="' . route('admin.employee.show', $employee->id) . '">' . e($employee->employee_id) . '</a>';

                // ২. কোনো গেট বা পারমিশন চেক ছাড়া সরাসরি অ্যাকশন বাটন জেনারেশন
                $actionColumn = '';
                if ($employee->employee_status == 'Active') {
                    // এডিট বাটন
                    $actionColumn .= '
                <a href="' . route('admin.employee.edit', $employee->id) . '" class="row-action-btn edit-action-teal-btn me-1" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa-solid fa-pencil"></i>
                </a>';

                    // স্ট্যান্ডার্ড ডিলিট ফর্ম এবং বাটন
                    $actionColumn .= '
                <div class="d-inline-block">
                    <form action="' . route('admin.employee.destroy', $employee->id) . '" method="POST" id="delete-form-' . $employee->id . '" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <a href="#" class="row-action-btn delete-action-pink-btn bs-pass-para" data-bs-toggle="tooltip" title="Delete">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </form>
                </div>';
                } else {
                    // স্ট্যাটাস একটিভ না থাকলে লক আইকন
                    $actionColumn = '<span class="text-muted pe-2"><i class="fa-solid fa-lock"></i></span>';
                }

                // ফাইনাল রো আউটপুট
                $htmlOutput .= '
            <tr>
                <td class="align-middle pl-0">' . $idColumn . '</td>
                <td class="align-middle text-light-gray">' . e($employee->employee_name) . '</td>
                <td class="align-middle text-light-gray">' . e($designationName) . '</td>
                <td class="align-middle text-light-gray">' . e($departmentName) . '</td>
                <td class="align-middle text-light-gray">' . e($sectionLineName) . '</td>
                <td class="align-middle text-light-gray">' . e($formattedDate) . '</td>
                <td class="aligned-right-column align-middle">' . $actionColumn . '</td>
            </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="7" class="text-center text-muted py-4">No employees found.</td></tr>';
        }

        return response()->json([
            'success' => true,
            'html'    => $htmlOutput,
            'summary' => $summaryText
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employeePrefix = Setting::where('name', 'employee_prefix')->pluck('value')->first();
        $employee = new Empofficeinfos();
        $employee = $employee->latest()->first();
        if ($employee) {
            $lastEmployeeId = $employee->employee_id;
            // Assuming the prefix is already included in the last employee ID, we remove it to get the numeric part
            $numericPart = str_replace($employeePrefix, '', $lastEmployeeId);
            $nextNumericPart = (int)$numericPart + 1;
            $nextEmployeeId = $employeePrefix . str_pad($nextNumericPart, 4, '0', STR_PAD_LEFT);
        } else {
            // If no employees exist yet, start with the prefix followed by 0001
            $nextEmployeeId = $employeePrefix . '0001';
        }

        $managers = Empofficeinfos::where('work_group', "Staff")->pluck('employee_name', 'id');

        $departments = Department::get()->pluck('name', 'id');
        $designations = Designation::get()->pluck('name', 'id');
        $branches = Branch::get()->pluck('name', 'id');
        $shifts = Shift::get()->pluck('name', 'id');
        $units = Unit::get()->pluck('name', 'id');
        $section_lines = SectionLine::get()->pluck('name', 'id');
        $grades = Grade::get()->pluck('name', 'id');
        $religions = Religion::get()->pluck('name', 'id');
        return view('employee.create', compact('nextEmployeeId', 'departments', 'designations', 'branches', 'shifts', 'units', 'section_lines', 'grades', 'religions', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employee_id' => 'required|unique:empofficeinfos,employee_id',
            'employee_name' => 'required',
            'employee_name_other' => 'nullable', // রিকোয়েস্টে যেহেতু আছে, ভ্যালিডেশনে রাখা ভালো
            'official_mail' => 'nullable|email|unique:empofficeinfos,official_mail',
            'designation' => 'required',
            'office' => 'required',
            'shift' => 'required',
            'unit' => 'required',
            'department' => 'required',
            'section_line' => 'required',
            'work_group' => 'required',
            'salary_type' => 'required',
            'card_no' => 'required|unique:empofficeinfos,card_no',
            'joining_date' => 'required|date',
            'grade' => 'required',
            'gross' => 'required|numeric',
            'second_gross' => 'nullable|numeric',
            'manager' => 'nullable|string|max:255',
            'job_location' => 'nullable|string|max:255',
            'probation_period' => 'nullable|string|max:255',
            'confirmation_date' => 'nullable|date',
            'is_ot_payable' => 'required',
            'is_masked' => 'required',
            'employee_status' => 'required',
            'discontinuation_date' => 'nullable|date',
            'discontinuation_reason' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'contact_number' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'national_id' => 'nullable|string|max:100',
            'birth_certificate' => 'nullable|string|max:100',
            'blood_group' => 'nullable|string|max:10',
            'marital_status' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_address' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            if ($request->input('employee_status') == 'Active') {
                $validatedData['discontinuation_date'] = null;
                $validatedData['discontinuation_reason'] = null;
            }

            $officeInfo = Empofficeinfos::create($validatedData);

            $validatedData['employee_id'] = $officeInfo->id;

            Emppersonalinfos::create($validatedData);

            DB::commit();

            return redirect()->route('admin.employee.index')->with('success', __('Employee successfully created.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Something went wrong: ') . $e->getMessage());
        }
    }

    public function show($id)
    {
        $employee = Empofficeinfos::with('emppersonalinfos')->findOrFail($id);
        return view('employee.profile', compact('employee'));
    }

    public function edit($id)
    {
        $managers = Empofficeinfos::where('work_group', "Staff")->pluck('employee_name', 'id');

        $departments = Department::get()->pluck('name', 'id');
        $designations = Designation::get()->pluck('name', 'id');
        $branches = Branch::get()->pluck('name', 'id');
        $shifts = Shift::get()->pluck('name', 'id');
        $units = Unit::get()->pluck('name', 'id');
        $section_lines = SectionLine::get()->pluck('name', 'id');
        $grades = Grade::get()->pluck('name', 'id');
        $religions = Religion::get()->pluck('name', 'id');
        $employee = Empofficeinfos::with('emppersonalinfos')->findOrFail($id);
        return view('employee.edit', compact('employee', 'managers', 'departments', 'designations', 'branches', 'shifts', 'units', 'section_lines', 'grades', 'religions'));
    }

    public function update(Request $request, $id)
    {

        // ডাটাবেজ থেকে আগের অবজেক্টটি খুঁজে বের করা
        $officeInfo = Empofficeinfos::findOrFail($id);

        // ভ্যালিডেশন (ইউনিক চেক করার সময় বর্তমান এমপ্লয়ির আইডি বাদ দিতে হবে, নাহলে এরর আসবে)
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'employee_name_other' => 'nullable',
            'official_mail' => 'nullable|email|unique:empofficeinfos,official_mail,' . $officeInfo->id,
            'designation' => 'required',
            'office' => 'required',
            'shift' => 'required',
            'unit' => 'required',
            'department' => 'required',
            'section_line' => 'required',
            'work_group' => 'required',
            'salary_type' => 'required',
            'card_no' => 'required|unique:empofficeinfos,card_no,' . $officeInfo->id,
            'joining_date' => 'required|date',
            'grade' => 'required',
            'gross' => 'required|numeric',
            'second_gross' => 'nullable|numeric',
            'manager' => 'nullable|string|max:255',
            'job_location' => 'nullable|string|max:255',
            'probation_period' => 'nullable|string|max:255',
            'confirmation_date' => 'nullable|date',
            'is_ot_payable' => 'required',
            'is_masked' => 'required',
            'employee_status' => 'required',
            'discontinuation_date' => 'nullable|date',
            'discontinuation_reason' => 'nullable|string|max:255',
            // পার্সোনাল ইনফো ফিল্ডস
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'height' => 'nullable|numeric',
            'contact_number' => 'nullable|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'nullable|string|max:20',
            'religion' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:50',
            'national_id' => 'nullable|string|max:100',
            'birth_certificate' => 'nullable|string|max:100',
            'blood_group' => 'nullable|string|max:10',
            'marital_status' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_address' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            if ($request->input('employee_status') == 'Active') {
                $validatedData['discontinuation_date'] = null;
                $validatedData['discontinuation_reason'] = null;
            }
            $officeInfo->update($validatedData);
            $officeInfo->emppersonalinfos()->updateOrCreate(
                ['employee_id' => $officeInfo->id],
                $validatedData
            );

            DB::commit();

            return redirect()->route('admin.employee.index')->with('success', __('Employee successfully updated.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('Something went wrong: ') . $e->getMessage());
        }
    }
}
