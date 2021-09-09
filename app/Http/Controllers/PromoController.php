<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = Promo::all();
        return view('Promo.index', compact('promo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Promo.create');
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
            'code' => 'min:5|unique:promos,code',
            'discount' => 'integer|min:0|max:100',
            'minimal_price' => 'integer|min:0',
            'valid' => 'date|after:today'
        ], [
            'code.min' => 'Promo Code Minimum 5 Character',
            'code.unique' => 'Promo Code Already Exist',
            'discount.min' => 'Discount Invalid, Value Cannot Negative',
            'discount.max' => 'Discount Invalid, Value Cannot More Than 100%',
            'minimal_price.min' => 'Minimal Order Invalid, Value Cannot Negative',
            'valid.after' => 'Date Invalid'
        ]);

        $promo = new Promo();
        $promo->code = $request->code;
        $promo->discount = $request->discount;
        $promo->minimal_price = $request->minimal_price;
        $promo->valid_until = $request->valid;
        $promo->save();

        return redirect('/promo')->with('notification', 'Promo Succesfully Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $id)
    {
        return  view('Promo.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $id)
    {
        $validate = $request->validate([
            'code' => 'min:5',
            'discount' => 'integer|min:0|max:100',
            'minimal_price' => 'integer|min:0',
            'valid' => 'date|after:today'
        ], [
            'code.min' => 'Promo Code Minimum 5 Character',
            'discount.min' => 'Discount Invalid, Value Cannot Negative',
            'discount.max' => 'Discount Invalid, Value Cannot More Than 100%',
            'minimal_price.min' => 'Minimal Order Invalid, Value Cannot Negative',
            'valid.after' => 'Date Invalid'
        ]);

        $id->code = $request->code;
        $id->discount = $request->discount;
        $id->minimal_price = $request->minimal_price;
        $id->valid_until = $request->valid;
        $id->save();

        return redirect('/promo')->with('notification', 'Promo Succesfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $id)
    {
        $id->delete();
        return redirect('/promo')->with('notification', 'Promo Succesfully Deleted');
    }
}
