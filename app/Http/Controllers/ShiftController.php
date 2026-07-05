<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Branch;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::orderBy("created_at", "desc")->paginate(10);
        return view('shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        return view('shift.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id'           => 'required|exists:branches,id',
            'name'                => 'required|string|max:255',
            'start_at'            => 'required|string',
            'break_start_at'      => 'required|string',
            'break_end_at'        => 'required|string',
            'end_at'              => 'required|string',
            'total_hours'         => 'required|string',
            'general_ot_start_at' => 'required|string',
            'general_ot_end_at'   => 'required|string',
            'extra_ot_start_at'   => 'required|string',
            'extra_ot_end_at'     => 'required|string',
        ], [
            'branch_id.required' => 'Please select a valid branch.',
            'name.required'      => 'The shift name field is required.'
        ]);

        try {
            // Eloquent Model instantiation and dynamic assignment
            $shift = new Shift();
            $shift->branch_id           = $request->input('branch_id');
            $shift->name                = $request->input('name');
            $shift->start_at            = $request->input('start_at');
            $shift->break_start_at      = $request->input('break_start_at');
            $shift->break_end_at        = $request->input('break_end_at');
            $shift->end_at              = $request->input('end_at');
            $shift->total_hours         = $request->input('total_hours');
            $shift->general_ot_start_at = $request->input('general_ot_start_at');
            $shift->general_ot_end_at   = $request->input('general_ot_end_at');
            $shift->extra_ot_start_at   = $request->input('extra_ot_start_at');
            $shift->extra_ot_end_at     = $request->input('extra_ot_end_at');
            $shift->created_by          = auth()->user()->id;

            $total_break_hours = 0;
            if ($request->break_start_at && $request->break_end_at) {
                $breakStart = \Carbon\Carbon::parse($request->break_start_at);
                $breakEnd = \Carbon\Carbon::parse($request->break_end_at);

                if ($breakEnd->lessThan($breakStart)) {
                    $breakEnd->addDay();
                }
                $total_break_hours = $breakStart->diffInMinutes($breakEnd) / 60;
            }


            $shift->total_break_hours = $total_break_hours;
            $shift->save();

            return response()->json([
                'success' => true,
                'message' => 'Shift structure configurations generated successfully!',
                'data'    => $shift
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to build shift execution logic: ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * 3. Handle dynamic live server-side datatable processing.
     */
    public function getShiftData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // Branch রিলেশন একসাথে লোড করা হচ্ছে
        $query = Shift::with('branch');

        // Search algorithm handler (Shift Name অথবা Branch Name দিয়ে সার্চ করা যাবে)
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Shift::count();
        $filteredRecords = $query->count();

        // Slicing and pagination processing
        if ($perPage === 'all') {
            $shifts = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $shifts->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $shifts = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($shifts->currentPage() - 1) * $shifts->perPage() + 1;
            $endEntry   = min($startEntry + $shifts->perPage() - 1, $shifts->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        // Generating Dynamic Rows
        $htmlOutput = '';
        if ($shifts->count() > 0) {
            foreach ($shifts as $shift) {
                $branchName = $shift->branch ? $shift->branch->name : 'N/A';

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($shift->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->start_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->break_start_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->break_end_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->end_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->total_hours) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->general_ot_start_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->general_ot_end_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->extra_ot_start_at) . '</td>
                    <td class="align-middle text-light-gray">' . e($shift->extra_ot_end_at) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $shift->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $shift->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="12" class="text-center text-muted py-4">No shift configurations found.</td></tr>';
        }

        return response()->json([
            'success' => true,
            'html'    => $htmlOutput,
            'summary' => $summaryText
        ], 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
