<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Termcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Termcategory::whereType('category')
                        ->when(request('search'), function($q) {
                            $q->where('title', 'like', '%'.request('search').'%')
                            ->orWhere('slug', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(10);
        return view('admin.blogs.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:100'],
        ]);

        Termcategory::create($request->all() + [
            'type' => 'category',
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Category created successfully.',
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:100'],
        ]);

        $termcategory = Termcategory::findOrFail($id);

        $termcategory->update($request->all() + [
            'type' => 'category',
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Category updated successfully.',
            'redirect' => route('admin.categories.index')
        ]);
    }

    public function destroy($id)
    {
        $termcategory = Termcategory::findOrFail($id);
        $termcategory->delete();
        return response()->json([
            'message' => 'Category deleted successfully.',
            'redirect' => route('admin.categories.index')
        ]);
    }
}
