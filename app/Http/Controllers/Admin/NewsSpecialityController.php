<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsSpeciality;
use Illuminate\Http\Request;

class NewsSpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = NewsSpeciality::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        NewsSpeciality::create($request->all());

        return response()->json([
            'message' => 'News Speciality created successfully.',
            'redirect' => route('admin.specialties.index')
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $specialties = NewsSpeciality::findOrFail($id);

        $specialties->update($request->all());

        return response()->json([
            'message' => 'News Speciality updated successfully.',
            'redirect' => route('admin.specialties.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specialties = NewsSpeciality::findOrFail($id);
        $specialties->delete();
        return response()->json([
            'message' => 'News specialty deleted successfully.',
            'redirect' => route('admin.specialties.index')
        ]);
    }
}
