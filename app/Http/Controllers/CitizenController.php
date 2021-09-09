<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\District;
use Carbon\Carbon;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citizen = Citizen::all();

        foreach ($citizen as $citizens) {
            $now = Carbon::now();
            $last_order = Carbon::createFromDate($citizens->last_order);
            $citizens->countdown = $now->diffInDays($last_order);
        }

        return view('Citizen.index', compact('citizen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district = District::all();
        return view('Citizen.create', compact('district'));
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
            'nik' => 'digits:16|unique:citizens,nik',
        ], [
            'nik.digits' => 'NIK Must Be 16 Digits',
            'nik.unique' => 'NIK Already Exist'
        ]);
        $now = Carbon::now();
        $now = $now->format('Y-m-d');
        $citizen = new Citizen();
        $citizen->nik = $request->nik;
        $citizen->name = $request->name;
        $citizen->district_id = $request->district;
        $citizen->last_order = $now;
        $citizen->save();

        return redirect('/citizen')->with('notification', 'Citizen Succesfully Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Citizen $id)
    {
        $district = District::all();
        return view('Citizen.edit', compact('district', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizen $id)
    {
        $validate = $request->validate([
            'nik' => 'digits:16',
        ], [
            'nik.digits' => 'NIK Must Be 16 Digits',
        ]);
        $id->nik = $request->nik;
        $id->name = $request->name;
        $id->district_id = $request->district;
        $id->save();

        return redirect('/citizen')->with('notification', 'Citizen Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citizen $id)
    {
        $id->delete();
        return back()->with('notification', 'Citizen Succesfully Deleted');
    }
}
