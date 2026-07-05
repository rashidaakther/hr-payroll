<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\Branch;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('religion.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::get()->pluck('name', 'id');
        return view('religion.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $religion = new Religion();
            $religion->name = $request->input('name');
            $religion->created_by = auth()->user()->id;
            $religion->save();

            return response()->json([
                'success' => true,
                'message' => 'Religion configured successfully!',
                'data'    => $religion
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save configuration: ' . $exception->getMessage()
            ], 500);
        }
    }

    public function getReligionData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Religion::query();

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        $totalRecords = Religion::count();

        if ($perPage === 'all') {
            $religions = $query->orderBy($sortBy, $sortOrder)->get();
            $itemsCount = $religions->count();
            $summaryText = "Showing 1 to {$itemsCount} of {$totalRecords} entries";
        } else {
            $religions = $query->orderBy($sortBy, $sortOrder)->paginate((int)$perPage);
            $startEntry = ($religions->currentPage() - 1) * $religions->perPage() + 1;
            $endEntry   = min($startEntry + $religions->perPage() - 1, $religions->total());
            $summaryText = "Showing {$startEntry} to {$endEntry} of {$totalRecords} entries";
        }

        $htmlOutput = '';
        if ($religions->count() > 0) {
            foreach ($religions as $religion) {
                $htmlOutput .= '
                <tr>
                    <td class="align-middle pl-0 text-light-gray">' . e($religion->name) . '</td>
                    <td class="aligned-right-column">
                        <button class="row-action-btn edit-action-teal-btn" data-id="' . $religion->id . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="row-action-btn delete-action-pink-btn" data-id="' . $religion->id . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="2" class="text-center text-muted py-4">No religion configurations found.</td></tr>';
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
    public function show(Religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Religion $religion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Religion $religion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Religion $religion)
    {
        //
    }
}
