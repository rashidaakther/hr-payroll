<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use App\Models\Branch;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('designation.index');
    }

    public function getDesignationData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // Eloquent 'department' relation লোড করা হচ্ছে
        $query = Designation::with('department');

        // Search filter logic
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('department', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Designation::count();
        $filteredRecords = $query->count();

        // Pagination and layout slice settings
        if ($perPage === 'all') {
            $designations = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $designations->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $designations = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($designations->currentPage() - 1) * $designations->perPage() + 1;
            $endEntry   = min($startEntry + $designations->perPage() - 1, $designations->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        // Generate HTML dynamic rows
        $htmlOutput = '';
        if ($designations->count() > 0) {
            foreach ($designations as $designation) {
                $deptName = $designation->department ? $designation->department->name : 'N/A';
                $branchName = $designation->branch ? $designation->branch->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($designation->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($deptName) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $designation->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $designation->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="3" class="text-center text-muted py-4">No designations found.</td></tr>';
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
        $departments = Department::get()->pluck('name', 'id'); // Fetching department names and their IDs for the dropdown
        $branches = Branch::get()->pluck('name', 'id'); // Fetching branch names and their IDs for the dropdown
        return view('designation.create', compact('departments', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'name'          => 'required|string|max:255',
        ], [
            'branch_id.required' => 'Please select a valid branch.',
            'department_id.required' => 'Please select a valid department.',
            'name.required'          => 'The designation name field is required.'
        ]);

        try {
            $designation = new Designation();
            $designation->branch_id = $request->input('branch_id');
            $designation->department_id = $request->input('department_id');
            $designation->name = $request->input('name');
            $designation->created_by = auth()->user()->id;
            $designation->save();

            return response()->json([
                'success' => true,
                'message' => 'Designation created successfully!',
                'data'    => $designation
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create designation: ' . $exception->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
