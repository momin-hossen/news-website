<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::when(request('search'), function($q) {
            $q->where('name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.services.index', compact('services'));
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|integer',
        ]);

        Service::create($request->except('icon') + [
            'icon' => $this->upload($request, 'icon')
        ]);

        return response()->json([
            'message' => 'Service created successfully.',
            'redirect' => route('admin.services.index')
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
            'status' => 'required|integer',
        ]);

        $services = Service::findOrFail($id);

        $services->update($request->except('icon') + [
            'icon' => $request->hasFile('icon') ? $this->upload($request, 'icon', $services->icon) : $services->icon

        ]);

        return response()->json([
            'message' => 'Service updated successfully.',
            'redirect' => route('admin.services.index')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        if (file_exists($service->icon ?? false)) {
            Storage::delete($service->icon);
        }
        $service->delete();

        return response()->json([
            'message' => __("Service deleted successfully"),
            'redirect' => route('admin.services.index')
        ]);
    }
}
