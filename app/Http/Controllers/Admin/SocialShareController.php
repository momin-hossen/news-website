<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialShare;
use Illuminate\Http\Request;

class SocialShareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_shares = SocialShare::when(request('search'), function($q) {
            $q->where('url', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.social_shares.index', compact('social_shares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.social_shares.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
            'follower' => 'required|numeric',
            'status' => 'required|integer',
        ]);

        SocialShare::create($request->all());

        return response()->json([
            'message' => 'Social Share created successfully.',
            'redirect' => route('admin.social_shares.index')
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
    public function edit(SocialShare $social_share)
    {
        return view('admin.social_shares.edit', compact('social_share'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
            'follower' => 'required|numeric',
            'status' => 'required|integer',
        ]);

        $social_shares = SocialShare::findOrFail($id);

        $social_shares->update($request->all());

        return response()->json([
            'message' => 'Social Share updated successfully.',
            'redirect' => route('admin.social_shares.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $social_shares = SocialShare::findOrFail($id);
        $social_shares->delete();
        return response()->json([
            'message' => 'Social Share deleted successfully.',
            'redirect' => route('admin.social_shares.index')
        ]);
    }
}
