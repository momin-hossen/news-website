<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company_settings = CompanySetting::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.company_settings.index', compact('company_settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'status' => 'required|integer',
        ]);

        CompanySetting::create($request->all());

        return response()->json([
            'message' => 'Company Setting created successfully.',
            'redirect' => route('admin.company_settings.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanySetting $company_setting)
    {
        return view('admin.company_settings.edit', compact('company_setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
            'status' => 'required|integer',
        ]);

        $company_settings = CompanySetting::findOrFail($id);

        $company_settings->update($request->all());


        return response()->json([
            'message' => 'Company Settings updated successfully.',
            'redirect' => route('admin.company_settings.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company_settings = CompanySetting::findOrFail($id);
        $company_settings->delete();
        return response()->json([
            'message' => 'Company Settings deleted successfully.',
            'redirect' => route('admin.company_settings.index')
        ]);
    }
}
