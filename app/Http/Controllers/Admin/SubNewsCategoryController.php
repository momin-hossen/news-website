<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use App\Models\SubNewsCategory;
use Illuminate\Http\Request;

class SubNewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_news_categories = SubNewsCategory::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->with('NewsCategory')
        ->latest()
        ->paginate(2);

        // $sub_news_categories = SubNewsCategory::with('SubNews')->get();
        $active_news_categories = NewsCategory::where("status", 1)->get();

        return view('admin.sub_news_categories.index', compact('sub_news_categories', 'active_news_categories'));
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

        SubNewsCategory::create($request->all());

        return response()->json([
            'message' => 'Sub News category created successfully.',
            'redirect' => route('admin.sub_news_categories.index')
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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'status' => 'required',
        // ]);

        // $sub_news_categories = SubNewsCategory::findOrFail($id);

        // $sub_news_categories->update($request->all());

        // return response()->json([
        //     'message' => 'Sub News Category updated successfully.',
        //     'redirect' => route('admin.sub_news_categories.index')
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
