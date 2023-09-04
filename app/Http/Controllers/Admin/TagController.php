<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\Termcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Termcategory::whereType('tags')
                ->when(request('search'), function($q) {
                    $q->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('slug', 'like', '%'.request('search').'%');
                })
                ->latest()
                ->paginate(10);

        return view('admin.blogs.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:100'],
        ]);

        Termcategory::create($request->all() + [
            'type' => 'tags',
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Tag created successfully.',
            'redirect' => route('admin.tags.index')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:2', 'max:100'],
        ]);

        $termcategory = Termcategory::findOrFail($id);

        $termcategory->update($request->all() + [
            'type' => 'tags',
            'slug' => Str::slug($request->title),
        ]);

        return response()->json([
            'message' => 'Tag updated successfully.',
            'redirect' => route('admin.tags.index')
        ]);
    }

    public function destroy($id)
    {
        $termcategory = Termcategory::findOrFail($id);
        $termcategory->delete();
        return response()->json([
            'message' => 'Tag deleted successfully.',
            'redirect' => route('admin.tags.index')
        ]);
    }
}
