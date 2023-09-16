<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Helpers\HasUploader;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsCategoryController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news_categories = NewsCategory::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.news_categories.index', compact('news_categories'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ]);
        NewsCategory::create($request->except('image') + [
            'slug' => Str::slug($request->name),
            'image' => $this->upload($request, 'image'),
        ]);

        return response()->json([
            'message' => 'News category created successfully.',
            'redirect' => route('admin.news_categories.index')
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

        $news_categories = NewsCategory::findOrFail($id);

        $news_categories->update($request->except('image') + [
            'slug' => Str::slug($request->name),
            'image' => $request->hasFile('image') ? $this->upload($request, 'image', $news_categories->image) : $news_categories->image


        ]);

        return response()->json([
            'message' => 'News Category updated successfully.',
            'redirect' => route('admin.news_categories.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $news_categories = NewsCategory::findOrFail($id);
        if (file_exists($news_categories->image ?? false)) {
            Storage::delete($news_categories->image);
        }
        $news_categories->delete();
        return response()->json([
            'message' => 'News Category deleted successfully.',
            'redirect' => route('admin.news_categories.index')
        ]);
    }
}
