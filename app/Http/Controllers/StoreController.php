<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    function index()
    {
        $store = Store::all();
        $user = User::where('role', 'user')->get();
        foreach ($store as $stores) {
            $owner = User::where('store_id', $stores->id)->first();
            $stores->owner = $owner->username;
        }
        return view('Store.index', compact('store'));
    }
}
