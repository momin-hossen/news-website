<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagline;
use Illuminate\Http\Request;

class TaglineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taglines = Tagline::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.taglines.index', compact('taglines'));
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
            'status' => 'required',
        ]);

        Tagline::create($request->all());

        return response()->json([
            'message' => 'Tagline created successfully.',
            'redirect' => route('admin.taglines.index')
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
            'status' => 'required',
        ]);

        $taglines = Tagline::findOrFail($id);

        $taglines->update($request->all());

        return response()->json([
            'message' => 'Tagline updated successfully.',
            'redirect' => route('admin.taglines.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taglines = Tagline::findOrFail($id);
        $taglines->delete();
        return response()->json([
            'message' => 'Tagline deleted successfully.',
            'redirect' => route('admin.taglines.index')
        ]);
    }
}
