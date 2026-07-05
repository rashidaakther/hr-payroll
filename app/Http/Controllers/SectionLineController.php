<?php

namespace App\Http\Controllers;

use App\Models\SectionLine;
use App\Models\Branch;
use App\Models\Unit;
use Illuminate\Http\Request;

class SectionLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sectionLine.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        $units = Unit::get()->pluck('name', 'id');
        return view('sectionLine.create', compact('branches', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'unit_id'   => 'required|exists:units,id',
            'name'      => 'required|string|max:255',
        ]);

        try {
            $sectionLine = new SectionLine();
            $sectionLine->branch_id = $request->input('branch_id');
            $sectionLine->unit_id   = $request->input('unit_id');
            $sectionLine->name      = $request->input('name');
            $sectionLine->created_by = auth()->user()->id;
            $sectionLine->save();

            return response()->json([
                'success' => true,
                'message' => 'Section/Line configured successfully!',
                'data'    => $sectionLine
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save configuration: ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * 3. Live Datatable JSON payload generator.
     */
    public function getSectionLineData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // Branch এবং Unit রিলেশনশিপ একসাথে লোড
        $query = SectionLine::with(['branch', 'unit']);

        // এডভান্সড গ্লোবাল সার্চ (Name, Branch বা Unit নাম লিখে সার্চ দেওয়া যাবে)
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('unit', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = SectionLine::count();

        if ($perPage === 'all') {
            $records = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $records->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $records = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($records->currentPage() - 1) * $records->perPage() + 1;
            $endEntry   = min($startEntry + $records->perPage() - 1, $records->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($records->count() > 0) {
            foreach ($records as $item) {
                $branchName = $item->branch ? $item->branch->name : 'N/A';
                $unitName   = $item->unit ? $item->unit->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($item->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="align-middle text-light-gray">' . e($unitName) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $item->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $item->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="4" class="text-center text-muted py-4">No sections or lines configured yet.</td></tr>';
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
    public function show(SectionLine $sectionLine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionLine $sectionLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionLine $sectionLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionLine $sectionLine)
    {
        //
    }
}
