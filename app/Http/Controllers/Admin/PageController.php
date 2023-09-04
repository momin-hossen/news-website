<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Term::where('type', 'pages')->latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'page_excerpt' => 'required|string',
            'page_content' => 'required|string',
            'keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        Term::create($request->only('title', 'status') + [
            'type' => 'pages',
            'slug' => Str::slug($request->title),
            'meta' => [
                'keywords' => $request->keywords,
                'page_excerpt' => $request->page_excerpt,
                'page_content' => $request->page_content,
                'meta_description' => $request->meta_description,
            ]
        ]);

        return response()->json([
            'message' => __("Page created successfully"),
            'redirect' => route('admin.pages.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page = Term::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'page_excerpt' => 'required|string',
            'page_content' => 'required|string',
            'keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $page = Term::findOrFail($id);

        $page->update($request->only('title', 'status') + [
            'slug' => Str::slug($request->title),
            'meta' => [
                'keywords' => $request->keywords,
                'page_excerpt' => $request->page_excerpt,
                'page_content' => $request->page_content,
                'meta_description' => $request->meta_description,
            ]
        ]);

        return response()->json([
            'message' => __("Page updated successfully"),
            'redirect' => route('admin.pages.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $page = Term::findOrFail($id);
        $page->delete();
        return response()->json([
            'message' => __("Page deleted successfully"),
            'redirect' => route('admin.pages.index')
        ]);
    }
}
