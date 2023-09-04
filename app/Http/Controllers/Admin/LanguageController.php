<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::latest()->paginate(10);
        $countries = base_path('lang/langlist.json');
        $countries = json_decode(file_get_contents($countries), true);

        return view('admin.settings.languages.index', compact('languages', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:50'],
            'code' => ['required', 'string', 'max:10']
        ]);

        $file = base_path('lang/' . $request->input('code') . '.json');
        if (!file_exists($file)){
            copy(base_path('lang/en.json'), $file);
        }

        Language::create($request->all());

        return response()->json([
            'message' => __('Language created successfully.'),
            'redirect' => route('admin.settings.languages.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $key)
    {
        $file = base_path('lang/' . $key . '.json');
        if (!file_exists($file)){
            copy(base_path('lang/en.json'), $file);
        }
        $phrases = file_get_contents($file);
        $phrases = json_decode($phrases);
        return view('admin.settings.languages.text', compact('phrases', 'key'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:50'],
            'code' => ['required', 'string', 'max:10'],
        ]);

        $file = base_path('lang/' . $request->input('code') . '.json');
        if (!file_exists($file)){
            copy(base_path('lang/en.json'), $file);
        }

        $lang = Language::findOrFail($id);
        $lang->update($request->all());

        return response()->json([
            'message' => __('Language created successfully.'),
            'redirect' => route('admin.settings.languages.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lang = Language::findOrFail($id);
        if (file_exists(base_path('lang/' . $lang->code . '.json'))) {
            unlink(base_path('lang/' . $lang->code . '.json'));
        }
        $lang->delete();

        return response()->json([
            'message' => __('Language deleted successfully.'),
            'redirect' => route('admin.settings.languages.index')
        ]);
    }

    public function updateText(Request $request, string $key)
    {
        $data = [];
        foreach ($request->values as $keyname => $row) {
            $data[$keyname] = $row;
        }
        $file = json_encode($data, JSON_PRETTY_PRINT);
        File::put(base_path('lang/' . $key . '.json'), $file);

        return response()->json(__("Texts updated successfully"));
    }

    public function addText(Request $request, string $key)
    {
        $request->validate([
            'key' => ['required', 'string', 'max:1000'],
            'value' => ['required', 'string', 'max:1000'],
        ]);

        $file = base_path('lang/' . $key . '.json');
        $posts = file_get_contents($file);
        $posts = json_decode($posts);
        foreach ($posts ?? [] as $keyname => $row) {
            $data[$keyname] = $row;
        }

        $data[$request->key] = $request->value;
        File::put(base_path('lang/' . $key . '.json'), json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            'message' => __('New text added successfully'),
            'redirect' => route('admin.settings.languages.edit', $key)
        ]);
    }
}
