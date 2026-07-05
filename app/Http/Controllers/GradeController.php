<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Branch;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('grade.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        return view('grade.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id'                => 'required|exists:branches,id',
            'name'                     => 'required|string|max:255',
            'basic_sly'                => 'required|numeric|min:0',
            'house_rent'               => 'required|numeric|min:0',
            'medical_allowance'        => 'required|numeric|min:0',
            'transportation_allowance' => 'required|numeric|min:0',
            'food_allowance'           => 'required|numeric|min:0',
            'total_approx_sly'         => 'required|numeric|min:0',
        ]);

        try {
            $grade = new Grade();
            $grade->branch_id                = $request->input('branch_id');
            $grade->name                     = $request->input('name');
            $grade->basic_sly                = $request->input('basic_sly');
            $grade->house_rent               = $request->input('house_rent');
            $grade->medical_allowance        = $request->input('medical_allowance');
            $grade->transportation_allowance = $request->input('transportation_allowance');
            $grade->food_allowance           = $request->input('food_allowance');
            $grade->total_approx_sly         = $request->input('total_approx_sly');
            $grade->created_by               = auth()->user()->id;
            $grade->save();

            return response()->json([
                'success' => true,
                'message' => 'Grade created successfully!',
                'data'    => $grade
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Grade config: ' . $exception->getMessage()
            ], 500);
        }
    }

    public function getGradeData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Grade::with('branch');

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Grade::count();

        if ($perPage === 'all') {
            $grades = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $grades->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $grades = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($grades->currentPage() - 1) * $grades->perPage() + 1;
            $endEntry   = min($startEntry + $grades->perPage() - 1, $grades->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($grades->count() > 0) {
            foreach ($grades as $grade) {
                $branchName = $grade->branch ? $grade->branch->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($grade->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="align-middle text-light-gray">' . number_format($grade->basic_sly, 2) . '</td>
                    <td class="align-middle text-light-gray">' . number_format($grade->house_rent, 2) . '</td>
                    <td class="align-middle text-light-gray">' . number_format($grade->medical_allowance, 2) . '</td>
                    <td class="align-middle text-light-gray">' . number_format($grade->transportation_allowance, 2) . '</td>
                    <td class="align-middle text-light-gray">' . number_format($grade->food_allowance, 2) . '</td>
                    <td class="align-middle text-success font-weight-bold">' . number_format($grade->total_approx_sly, 2) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $grade->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $grade->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="9" class="text-center text-muted py-4">No grades configured found.</td></tr>';
        }

        return response()->json([
            'success' => true,
            'html'    => $htmlOutput,
            'summary' => $summaryText
        ], 200, ['Content-Type' => 'application/json; charset=UTF-8']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
