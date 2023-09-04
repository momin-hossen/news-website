<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::when(request('search'), function($q) {
            $q->where('title', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.portfolios.index', compact('portfolios'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        Portfolio::create($request->except('image') + [
            'image' => $this->upload($request, 'image')
        ]);

        return response()->json([
            'message' => 'Portfolio created successfully.',
            'redirect' => route('admin.portfolios.index')
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
            'title' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $portfolios = Portfolio::findOrFail($id);

        $portfolios->update($request->except('image') + [
            'image' => $request->hasFile('image') ? $this->upload($request, 'image', $portfolios->image) : $portfolios->image

        ]);

        return response()->json([
            'message' => 'Portfolio updated successfully.',
            'redirect' => route('admin.portfolios.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolios = Portfolio::findOrFail($id);
        if (file_exists($portfolios->icon ?? false)) {
            Storage::delete($portfolios->icon);
        }
        $portfolios->delete();

        return response()->json([
            'message' => __("Portfolio deleted successfully"),
            'redirect' => route('admin.portfolios.index')
        ]);
    }
}
