<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    use HasUploader;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Option::where('key', 'LIKE', '%seo_%')->paginate(10);
        return view('admin.settings.seo.index', compact('datas'));
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
        //
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
        $seo = Option::findOrFail($id);
        return view('admin.settings.seo.edit', compact('seo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tag' => 'nullable|string|max:250',
            'image' => 'nullable|image|max:1024',
            'site_name' => 'required|string|max:250',
            'site_title' => 'nullable|string|max:250',
            'description' => 'nullable|string|max:2000',
        ]);

        $seo = Option::findOrFail($id);
        Cache::forget($seo->key);

        $seo->update([
            'value' => [
                "tag" => $request->tag,
                "site_name" => $request->site_name,
                "site_title" => $request->site_title,
                "description" => $request->description,
                'image' => $request->image ? $this->upload($request, 'image') : null,
            ]
        ]);

        return response()->json([
            'redirect' => route('admin.settings.seo.index'),
            'message' => __('Seo updated successfully.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seo = Option::findOrFail($id);
        if (file_exists($seo->value['image'] ?? false)) {
            Storage::delete($seo->value['image']);
        }
        $seo->delete();
        return response()->json([
            'redirect' => route('admin.settings.seo.index'),
            'message' => __('Seo deleted successfully.')
        ]);
    }
}
