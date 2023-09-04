<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_links = SocialLink::when(request('search'), function($q) {
            $q->where('class_name', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(1);

        return view('admin.social_links.index', compact('social_links'));
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
            'class_name' => 'required|string|max:255',
        ]);

        SocialLink::create($request->all());

        return response()->json([
            'message' => 'Social Link created successfully.',
            'redirect' => route('admin.social_links.index')
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
            'class_name' => 'required|string|max:255',
        ]);

        $social_links = SocialLink::findOrFail($id);

        $social_links->update($request->all());

        return response()->json([
            'message' => 'Social Link updated successfully.',
            'redirect' => route('admin.social_links.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $social_links = SocialLink::findOrFail($id);
        $social_links->delete();
        return response()->json([
            'message' => 'Social Link deleted successfully.',
            'redirect' => route('admin.social_links.index')
        ]);
    }
}
