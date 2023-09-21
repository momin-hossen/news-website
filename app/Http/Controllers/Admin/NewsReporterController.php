<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HasUploader;
use App\Models\NewsReporter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsReporterController extends Controller
{
    use HasUploader;
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
        return view('admin.reporters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'nid_no' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'joining_date' => 'required|date',
            'password' => 'required|string|min:8',
            'role' => 'required|integer',
        ]);

        NewsReporter::create($request->except('image') + [
            'image' => $this->upload($request, 'image')
        ]);

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
    public function edit(NewsReporter $reporter)
    {
        return view('admin.reporters.edit', compact('reporter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'nid_no' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'present_address' => 'required|string',
            'permanent_address' => 'required|string',
            'joining_date' => 'required|date',
            'password' => 'required|string|min:8',
            'role' => 'required|integer',
        ]);

        $reporters = NewsReporter::findOrFail($id);

        $reporters->update($request->except('image') + [
            'image' => $request->hasFile('image') ? $this->upload($request, 'image', $reporters->image) : $reporters->image
        ]);


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
        if (file_exists($reporters->image ?? false)) {
            Storage::delete($reporters->image);
        }
        $reporters->delete();
        return response()->json([
            'message' => 'News Reporter deleted successfully.',
            'redirect' => route('admin.reporters.index')
        ]);
    }
}
