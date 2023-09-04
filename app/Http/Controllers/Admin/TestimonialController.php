<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.testimonials.index', compact('testimonials'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        Testimonial::create($request->except('image') + [
            'image' => $this->upload($request, 'image')
        ]);

        return response()->json([
            'message' => 'Testimonial created successfully.',
            'redirect' => route('admin.testimonials.index')
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $testimonials = Testimonial::findOrFail($id);

        $testimonials->update($request->except('image') + [
            'image' => $request->hasFile('image') ? $this->upload($request, 'image', $testimonials->image) : $testimonials->image

        ]);

        return response()->json([
            'message' => 'Testimonial updated successfully.',
            'redirect' => route('admin.testimonials.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if (file_exists($testimonial->image ?? false)) {
            Storage::delete($testimonial->image);
        }
        $testimonial->delete();
        return response()->json([
            'message' => __("Testimonial deleted successfully"),
            'redirect' => route('admin.testimonials.index')
        ]);
    }
}
