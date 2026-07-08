<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ১. ম্যানুয়াল ভ্যালিডেশন মেকার
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|unique:settings,name', // আপনার টেবিল নাম Setting হলে ঠিক আছে
            'value' => 'required|string|max:255',
        ], [
            'name.unique' => 'This Setting Type has already been configured!',
        ]);

        // ভ্যালিডেশন ফেল করলে AJAX ফ্রেন্ডলি JSON রেসপন্স পাঠানো
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first() // প্রথম যে এররটি আসবে সেটি দেখাবে
            ], 422); // ৪২২ হলো Unprocessable Entity (ভ্যালিডেশন এরর স্ট্যান্ডার্ড)
        }

        try {
            // ২. ডেটাবেসে নতুন রেকর্ড তৈরি করা
            $setting = new Setting();
            $setting->name       = $request->input('name');
            $setting->value      = $request->input('value');
            $setting->created_by = auth()->user()->id;
            $setting->save();

            return response()->json([
                'success' => true,
                'message' => 'Setting configured successfully!',
                'data'    => $setting
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save configuration: ' . $exception->getMessage()
            ], 500);
        }
    }

    public function getSettingData(Request $request)
    {
        $search    = $request->get('search', '');
        $perPage   = $request->get('per_page', 10);
        $sortBy    = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        // HrSetting কোয়েরি শুরু
        $query = Setting::query();

        // অ্যাডভান্সড গ্লোবাল সার্চ (Setting Type অথবা Value দিয়ে সার্চ করা যাবে)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('value', 'LIKE', '%' . $search . '%');
            });
        }

        // ফিল্টারিং করার আগের টোটাল রেকর্ড কাউন্ট
        $totalRecords = Setting::count();

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
                // "employee_prefix" কে রিডেবল ফরম্যাট "Employee Prefix" এ কনভার্ট করার জন্য
                $displayType = ucwords(str_replace('_', ' ', $item->name));

                $htmlOutput .= '
            <tr>
                <td class="align-middle pl-0 text-light-gray">' . e($displayType) . '</td>
                <td class="align-middle text-light-gray">
                    <span class="badge px-2 py-1" style="background-color: var(--bg-input); border: 1px solid var(--input-border); color: #4ade80;">
                        ' . e($item->value) . '
                    </span>
                </td>
                <td class="aligned-right-column">
                    <button class="row-action-btn edit-action-teal-btn" data-id="' . $item->id . '" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                    </button>
                    <button class="row-action-btn delete-action-pink-btn" data-id="' . $item->id . '" title="Delete">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>';
            }
        } else {
            $htmlOutput = '<tr><td colspan="3" class="text-center text-muted py-4">No settings configured yet.</td></tr>';
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
