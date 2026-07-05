<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Branch;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('unit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        return view('unit.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|string|max:255',
        ], [
            'branch_id.required' => 'Please select a valid branch.',
            'name.required'      => 'The unit name field is required.'
        ]);

        try {
            $unit = new Unit();
            $unit->branch_id = $request->input('branch_id');
            $unit->name      = $request->input('name');
            $unit->save();

            return response()->json([
                'success' => true,
                'message' => 'Unit created successfully!',
                'data'    => $unit
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create unit: ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * 3. Handle dynamic live Datatable requests for Unit.
     */
    public function getUnitData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // Branch রিলেশনশিপসহ কুয়েরি লোড
        $query = Unit::with('branch');

        // Search ফিল্টার (Unit Name অথবা Branch Name দিয়ে খোঁজা যাবে)
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Unit::count();

        // Pagination লজিক
        if ($perPage === 'all') {
            $units = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $units->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $units = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($units->currentPage() - 1) * $units->perPage() + 1;
            $endEntry   = min($startEntry + $units->perPage() - 1, $units->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        // HTML রো জেনারেশন
        $htmlOutput = '';
        if ($units->count() > 0) {
            foreach ($units as $unit) {
                $branchName = $unit->branch ? $unit->branch->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($unit->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $unit->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $unit->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="3" class="text-center text-muted py-4">No units found.</td></tr>';
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
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
