<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsReporter;
use Illuminate\Http\Request;

class NewsReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reporters = NewsReporter::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.reporters.index', compact('reporters'));
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
            'email' => 'required|email',
        ]);

        NewsReporter::create($request->all());

        return response()->json([
            'message' => 'News Reporter created successfully.',
            'redirect' => route('admin.reporters.index')
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
            'email' => 'required|email',
        ]);

        $reporters = NewsReporter::findOrFail($id);

        $reporters->update($request->all());

        return response()->json([
            'message' => 'News Reporter updated successfully.',
            'redirect' => route('admin.reporters.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reporters = NewsReporter::findOrFail($id);
        $reporters->delete();
        return response()->json([
            'message' => 'News Reporter deleted successfully.',
            'redirect' => route('admin.reporters.index')
        ]);
    }
}
