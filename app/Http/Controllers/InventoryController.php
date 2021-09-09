<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_id = Auth::user()->store_id;
        $inventory = Inventory::where('store_id', $store_id)->get();
        return view('Inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'amount' => 'integer|min:0',
            'price' => 'integer|min:0'
        ], [
            'amount.min' => 'Amount Cannot be Negative',
            'price.min' => 'Price Cannot be Negative'
        ]);

        if ($request->subsidi == 1) {
            $x = Inventory::where('store_id', Auth::user()->store_id)->where('subsidi', 1)->count();
            if ($x > 0) {
                return back()->with('notification-danger', 'Inventory Bersubsidi Cannot More Than 1 ');
            } else {
                $inventory = new Inventory();
                $inventory->name = $request->name;
                $inventory->amount = $request->amount;
                $inventory->price = $request->price;
                $inventory->subsidi = $request->subsidi;
                $inventory->store_id = Auth::user()->store_id;
            }
        } else {
            $inventory = new Inventory();
            $inventory->name = $request->name;
            $inventory->amount = $request->amount;
            $inventory->price = $request->price;
            $inventory->subsidi = $request->subsidi;
            $inventory->store_id = Auth::user()->store_id;
        }
        $inventory->save();

        return redirect('/inventory')->with('notification', 'Inventory Succesfully Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $id)
    {
        return view('Inventory.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $id)
    {

        $validate = $request->validate([
            'amount' => 'integer|min:0',
            'price' => 'integer|min:0'
        ], [
            'amount.min' => 'Amount Cannot be Negative',
            'price.min' => 'Price Cannot be Negative'
        ]);
        if ($request->subsidi == 1) {
            $x = Inventory::where('store_id', Auth::user()->store_id)->where('subsidi', 1)->count();
            if ($x > 1) {
                return back()->with('notification-danger', 'Inventory Bersubsidi Cannot More Than 1 ');
            } else {
                $id->name = $request->name;
                $id->amount = $request->amount;
                $id->price = $request->price;
                $id->subsidi = $request->subsidi;
                $id->store_id = Auth::user()->store_id;
            }
        } else {
            $id->name = $request->name;
            $id->amount = $request->amount;
            $id->price = $request->price;
            $id->subsidi = $request->subsidi;
            $id->store_id = Auth::user()->store_id;
        }
        $id->save();

        return redirect('/inventory')->with('notification', 'Inventory Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $id)
    {
        $id->delete();
        return redirect('/inventory')->with('notification', 'Inventory Succesfully Deleted');
    }
}
