<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use Illuminate\Support\Str;
use App\Helpers\HasUploader;
use App\Models\Termcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    use HasUploader;

    public function index()
    {
        $terms = Term::whereType('blogs')->latest()->paginate(10);
        return view('admin.blogs.index', compact('terms'));
    }

    public function create()
    {
        $tags = Termcategory::whereType('tags')->whereStatus(1)->pluck('title', 'id');
        $categories = Termcategory::whereType('category')->whereStatus(1)->pluck('title', 'id');
        return view('admin.blogs.create', compact('tags', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:terms,title',
            'status' => 'required|integer',
            'lang' => 'required|string',
            'description' => 'nullable|string',
            'comment_status' => 'required|integer',
            'keywords' => 'nullable|string|max:200',
            'image' => 'required|image|max:1024',
            'seo_image' => 'nullable|image|max:1024',
            'meta_description' => 'nullable|string|max:200',
        ]);

        $blog = Term::create($request->all() + [
            'slug' => Str::slug($request->title),
            'type' => 'blogs',
            'meta' => [
                'keywords' => $request->keywords,
                'meta_description' => $request->meta_description,
                'image' => $request->image ? $this->upload($request, 'image') : null,
                'seo_image' => $request->seo_image ? $this->upload($request, 'seo_image') : null,
            ]
        ]);

        if (!empty($request->categories)) {
            $blog->categories()->sync($request->categories);
        }

        if (!empty($request->tags)) {
            $blog->tags()->sync($request->tags);
        }

        return response()->json([
            'message' => __("Blog Created Successfully"),
            'redirect' => route('admin.blogs.index')
        ]);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $term = Term::with('categories:id,title', 'tags:id,title')->findOrFail($id);
        $tags = Termcategory::whereType('tags')->whereStatus(1)->pluck('title', 'id');
        $categories = Termcategory::whereType('category')->whereStatus(1)->pluck('title', 'id');
        return view('admin.blogs.edit', compact('term', 'tags', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|integer',
            'title' => 'required|string|unique:terms,title,'.$id,
            'lang' => 'required|string',
            'description' => 'nullable|string',
            'comment_status' => 'required|integer',
            'keywords' => 'nullable|string|max:200',
            'image' => 'nullable|image|max:1024',
            'seo_image' => 'nullable|image|max:1024',
            'meta_description' => 'nullable|string|max:200',
        ]);

        $blog = Term::findOrFail($id);

        $blog->update($request->all() + [
            'slug' => Str::slug($request->title),
            'type' => 'blogs',
            'meta' => [
                'keywords' => $request->keywords,
                'meta_description' => $request->meta_description,
                'image' => $request->image ? $this->upload($request, 'image') : $blog->meta['image'] ?? NULL,
                'seo_image' => $request->seo_image ? $this->upload($request, 'seo_image') : $blog->meta['seo_image'] ?? NULL,
            ]
        ]);

        if ($request->image && file_exists($blog->meta['image'] ?? false)) {
            Storage::delete($blog->meta['image']);
        }
        if ($request->seo_image && file_exists($blog->meta['seo_image'] ?? false)) {
            Storage::delete($blog->meta['seo_image']);
        }

        $blog->tags()->sync($request->tags);
        $blog->categories()->sync($request->categories);

        return response()->json([
            'message' => __("Blog Updated Successfully"),
            'redirect' => route('admin.blogs.index')
        ]);
    }

    public function destroy(string $id)
    {
        $blog = Term::findOrFail($id);
        if (file_exists($blog->meta['image'] ?? false)) {
            Storage::delete($blog->meta['image']);
        }
        if (file_exists($blog->meta['seo_image'] ?? false)) {
            Storage::delete($blog->meta['seo_image']);
        }
        $blog->delete();
        return response()->json([
            'message' => __("Blog deleted successfully"),
            'redirect' => route('admin.blogs.index')
        ]);
    }
}
