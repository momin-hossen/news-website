<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $experiences = Experience::when(request('search'), function($q) {
            $q->where('title', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.experiences.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|integer',
        ]);

        Experience::create($request->all());

        return response()->json([
            'message' => 'Experience created successfully.',
            'redirect' => route('admin.experiences.index')
        ]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|integer',
        ]);

        $experiences = Experience::findOrFail($id);

        $experiences->update($request->all());

        return response()->json([
            'message' => 'Experience updated successfully.',
            'redirect' => route('admin.experiences.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experiences = Experience::findOrFail($id);
        $experiences->delete();
        return response()->json([
            'message' => 'Experience deleted successfully.',
            'redirect' => route('admin.experiences.index')
        ]);
    }
}
