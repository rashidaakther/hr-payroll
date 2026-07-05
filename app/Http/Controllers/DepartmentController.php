<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Branch;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('department.index');
    }

    public function getDepartmentData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // Eloquent 'branch' relation লোড করা হচ্ছে যেন ব্রাঞ্চের নাম দেখানো যায়
        $query = Department::with('branch');

        // Search logic (Department name অথবা Branch name দিয়ে খোঁজা যাবে)
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Department::count();
        $filteredRecords = $query->count();

        // Pagination/Slice management
        if ($perPage === 'all') {
            $departments = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $departments->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $departments = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($departments->currentPage() - 1) * $departments->perPage() + 1;
            $endEntry   = min($startEntry + $departments->perPage() - 1, $departments->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        // HTML Output string generation
        $htmlOutput = '';
        if ($departments->count() > 0) {
            foreach ($departments as $department) {
                // রিলেশনশিপ সেফটি চেক (যদি কোনো কারণে ব্রাঞ্চ ডিলিট হয়ে থাকে)
                $branchName = $department->branch ? $department->branch->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($department->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $department->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $department->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="3" class="text-center text-muted py-4">No departments found.</td></tr>';
        }

        return response()->json([
            'success' => true,
            'html'    => $htmlOutput,
            'summary' => $summaryText
        ], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        return view('department.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Form validation rules
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|string|max:255',
        ], [
            'branch_id.required' => 'Please select a valid branch.',
            'name.required'      => 'The department name field is required.'
        ]);

        try {
            // 2. Initializing the Department Model and saving data
            $department = new Department();
            $department->branch_id = $request->input('branch_id');
            $department->name = $request->input('name');
            $department->created_by = auth()->user()->id;
            $department->save(); // Save record into database

            // 3. Return structured JSON response for the global AJAX handler
            return response()->json([
                'success' => true,
                'message' => 'Department created successfully!',
                'data'    => $department
            ], 201);
        } catch (\Exception $exception) {
            // Fallback error tracing mapping pipeline
            return response()->json([
                'success' => false,
                'message' => 'Failed to create department: ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
