<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Branch;
use App\Models\Shift;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('holiday.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        $shifts = Shift::get()->pluck('name', 'id');
        return view('holiday.create', compact('branches', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'branch_id'   => 'required|exists:branches,id',
            'shift_id'    => 'required|exists:shifts,id',
            'holidayType' => 'required|string',
            'name'        => 'required|string|max:255',
            'year'        => 'required|integer',
            'month'       => 'required|integer|between:1,12',
            'from'        => 'required|date',
            'to'          => 'required|date|after_or_equal:from',
            'total_day'   => 'required|integer|min:1',
        ]);

        try {
            $holiday = new Holiday();
            $holiday->branch_id   = $request->input('branch_id');
            $holiday->shift_id    = $request->input('shift_id');
            $holiday->holidayType = $request->input('holidayType');
            $holiday->name        = $request->input('name');
            $holiday->year        = $request->input('year');
            $holiday->month       = $request->input('month');
            $holiday->from        = $request->input('from');
            $holiday->to          = $request->input('to');
            $holiday->total_day   = $request->input('total_day');
            $holiday->status      = $request->input('status', 1);
            $holiday->created_by  = auth()->user()->id; // অথবা auth()->user()->id
            $holiday->save();

            return response()->json([
                'success' => true,
                'message' => 'Holiday configured successfully!',
                'data'    => $holiday
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save configuration: ' . $exception->getMessage()
            ], 500);
        }
    }

    public function getHolidayData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Holiday::with(['branch', 'shift']);

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('holidayType', 'LIKE', '%' . $search . '%')
                ->orWhereHas('branch', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%');
                });
        }

        $totalRecords = Holiday::count();

        if ($perPage === 'all') {
            $holidays = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $holidays->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $holidays = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($holidays->currentPage() - 1) * $holidays->perPage() + 1;
            $endEntry   = min($startEntry + $holidays->perPage() - 1, $holidays->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($holidays->count() > 0) {
            foreach ($holidays as $holiday) {
                $branchName = $holiday->branch ? $holiday->branch->name : 'N/A';
                $shiftName  = $holiday->shift ? $holiday->shift->name : 'N/A';
                $formattedFrom = date('d M, Y', strtotime($holiday->from));
                $formattedTo   = date('d M, Y', strtotime($holiday->to));

                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($holiday->name) . '</td>
                    <td class="align-middle text-light-gray">' . e($branchName) . '</td>
                    <td class="align-middle text-light-gray">' . e($shiftName) . '</td>
                    <td class="align-middle text-light-gray"><span class="badge bg-secondary">' . e($holiday->holidayType) . '</span></td>
                    <td class="align-middle text-light-gray">' . $formattedFrom . ' to ' . $formattedTo . '</td>
                    <td class="align-middle text-success font-weight-bold">' . e($holiday->total_day) . ' Days</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $holiday->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $holiday->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="7" class="text-center text-muted py-4">No holiday configurations found.</td></tr>';
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
    public function show(Holiday $holiday)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        //
    }
}
