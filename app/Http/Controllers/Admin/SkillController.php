<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::when(request('search'), function($q) {
                    $q->where('name', 'like', '%'.request('search').'%');
                })
                ->latest()
                ->paginate(1);

        return view('admin.skills.index', compact('skills'));
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
            'percent' => 'required|numeric',
            'status' => 'required|integer',
        ]);

        Skill::create($request->all());

        return response()->json([
            'message' => 'Skill created successfully.',
            'redirect' => route('admin.skills.index')
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
            'percent' => 'required|numeric',
            'status' => 'required|integer',
        ]);

        $skills = Skill::findOrFail($id);

        $skills->update($request->all());

        return response()->json([
            'message' => 'Skill updated successfully.',
            'redirect' => route('admin.skills.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skills = Skill::findOrFail($id);
        $skills->delete();
        return response()->json([
            'message' => 'Skill deleted successfully.',
            'redirect' => route('admin.skills.index')
        ]);
    }
}
