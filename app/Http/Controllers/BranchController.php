<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('branch.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Form validation rules and localized English error messages
        $request->validate([
            'name' => 'required|string|max:255|unique:branches,name',
        ], [
            'name.required' => 'The branch name field is required.',
            'name.unique'   => 'This branch name has already been registered in the database.'
        ]);

        try {
            // 2. Initializing the Eloquent Model and saving the data
            $branch = new Branch();
            $branch->name = $request->input('name');
            $branch->created_by = auth()->user()->id;
            $branch->save(); // Commits the row entry directly to the database

            // 3. Returning a structured JSON response for your AJAX script
            return response()->json([
                'success' => true,
                'message' => 'Branch record saved successfully!',
                'data'    => $branch
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
    public function getBranchData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Branch::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $totalRecords = Branch::count();
        $filteredRecords = $query->count();

        if ($perPage === 'all') {
            $branches = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $branches->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $branches = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($branches->currentPage() - 1) * $branches->perPage() + 1;
            $endEntry   = min($startEntry + $branches->perPage() - 1, $branches->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($branches->count() > 0) {
            foreach ($branches as $branch) {
                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($branch->name) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $branch->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $branch->id . '">
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
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
