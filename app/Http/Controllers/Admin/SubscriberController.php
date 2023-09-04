<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::when(request('search'), function($q) {
            $q->where('email', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(5);

        return view('admin.subscribers.index', compact('subscribers'));
    }
}
