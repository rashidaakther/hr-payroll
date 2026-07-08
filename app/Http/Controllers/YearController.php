<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('year.index');
    }

    public function getYearData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Year::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $totalRecords = Year::count();
        $filteredRecords = $query->count();

        if ($perPage === 'all') {
            $years = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $years->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $years = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($years->currentPage() - 1) * $years->perPage() + 1;
            $endEntry   = min($startEntry + $years->perPage() - 1, $years->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($years->count() > 0) {
            foreach ($years as $year) {
                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($year->name) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $year->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $year->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="2" class="text-center text-muted py-4">No records found.</td></tr>';
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
        return view('year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Form validation rules and localized English error messages
        $request->validate([
            'name' => 'required|string|max:255|unique:years,name',
        ], [
            'name.required' => 'The year name field is required.',
            'name.unique'   => 'This year name has already been registered in the database.'
        ]);

        try {
            // 2. Initializing the Eloquent Model and saving the data
            $year = new Year();
            $year->name = $request->input('name');
            $year->created_by = auth()->user()->id;
            $year->save(); // Commits the row entry directly to the database

            // 3. Returning a structured JSON response for your AJAX script
            return response()->json([
                'success' => true,
                'message' => 'Year record saved successfully!',
                'data'    => $year
            ], 201);
        } catch (\Exception $exception) {
            // Error handling fallback if something crashes during the process
            return response()->json([
                'success' => false,
                'message' => 'Execution failed due to a server error: ' . $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        //
    }
}
