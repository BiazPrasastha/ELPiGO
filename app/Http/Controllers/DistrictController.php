<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district = District::all();
        return view('District.index', compact('district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('District.create');
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
            'name' => 'unique:districts,name'
        ], [
            'name.unique' => 'District Already Exist'
        ]);

        $district = new District();
        $district->name = $request->name;
        $district->save();

        return redirect('/district')->with('notification', 'District Succesfully Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(District $id)
    {
        return view('District.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $id)
    {
        $validate = $request->validate([
            'name' => 'unique:districts,name'
        ], [
            'name.unique' => 'District Already Exist'
        ]);

        $id->name = $request->name;
        $id->save();

        return redirect('/district')->with('notification', 'District Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $id)
    {
        $id->delete();
        return back()->with('notification', 'District Succesfully Updated');
    }
}
