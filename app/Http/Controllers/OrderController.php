<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\Promo;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_subsidi()
    {
        return view('Order.index_subsidi');
    }

    public function index_non_subsidi()
    {
        $store_id = Auth::user()->store_id;
        $product = Inventory::where('store_id', $store_id)->where('subsidi', 0)->get();
        return view('Order.index_non_subsidi', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        if ($request->subsidi == 1) {
            $now = Carbon::now();
            $now = $now->format('Y-m-d');

            $order->inventory_id = $request->inventory;
            $order->quantity = $request->qty;
            $order->promo_id = null;
            $order->store_id = Auth::user()->store_id;
            $order->total_price = $request->price;
            $order->type = $request->subsidi;
            $order->save();

            $citizen = Citizen::where('nik', $request->nik)->first();
            $citizen->last_order = $now;
            $citizen->save();

            return redirect('/order/subsidi')->with('notification', 'Order Successfull Created');
        } elseif ($request->subsidi == 0) {
            $total_price = $request->inventory;
            $total_price = Inventory::where('id', $total_price)->first();
            $total_price = $total_price->price * $request->qty;

            if ($request->promo == null) {
                $order->promo_id = null;
            } else {
                $promo = Promo::where('code', $request->promo)->first();
                $discount = $total_price * $promo->discount / 100;
                $total_price = $total_price - $discount;
                $order->promo_id = $promo->id;
            }

            $order->inventory_id = $request->inventory;
            $order->total_price = $total_price;
            $order->quantity = $request->qty;
            $order->store_id = Auth::user()->store_id;
            $order->type = $request->subsidi;
        }

        $order->save();
        return redirect('/order/non-subsidi')->with('notification', 'Order Successfull Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $store_id = Auth::user()->store_id;
        $order = Order::where('store_id', $store_id)->orderBy('created_at', 'DESC')->get();
        return view('Order.show', compact('order'));
    }

    function invoice(Request $request)
    {
        $now = Carbon::now();
        $now = $now->format('Y-m-d');
        $hidden1 = $request->subsidi;

        if ($request->subsidi == 1) {
            $qty = 1;
            $product = Inventory::where('store_id', Auth::user()->store_id)->where('subsidi', 1)->first();
            $hasPromo = 2;
            $hidden2 = $request->nik;
            $hidden3 = $request->name;

            $nik_not_found = Citizen::where('nik', $hidden2)->first();
            if ($nik_not_found == null) {
                return back()->with('notification-danger', 'NIK not found, Please Check Again NIK');
            } else {
                if ($nik_not_found->name == $hidden3) {
                    $now = Carbon::now();
                    $last_order = Carbon::createFromDate($nik_not_found->last_order);
                    $countdown = $now->diffInDays($last_order);
                    if ($countdown >= 30) {
                        return view('Order.invoice', compact('now', 'qty', 'product', 'hasPromo', 'hidden1', 'hidden2', 'hidden3'));
                    } else {
                        $day = 30 - $countdown;
                        return back()->with('notification-danger', 'Order Failed, Wait ' . $day . ' Days, To Order LPG Berubsidi Again');
                    }
                } else {
                    return back()->with('notification-danger', 'NIK and Name not match, Please Check Again NIK & Name');
                }
            }
        }
        if ($request->subsidi == 0) {

            $validate = $request->validate([
                'inventory' => 'required',
                'qty' => 'integer|min:1'
            ], [
                'inventory.required' => 'Failed Please Select Product',
                'qty.min' => 'Quantity Cannot Be Zero or Negative'
            ]);

            $hidden2 = $request->inventory;
            $hidden3 = $request->qty;
            $hidden4 = $request->promo;

            if ($request->promo == null) {
                $qty = $request->qty;
                $product = Inventory::where('id', $request->inventory)->first();
                $hasPromo = 0;
                return view('Order.invoice', compact('now', 'qty', 'product', 'hasPromo', 'hidden1', 'hidden2', 'hidden3', 'hidden4'));
            }

            $promo = Promo::where('code', $request->promo)->first();
            if ($promo == null) {
                return back()->with('notification-danger', 'Promo Invalid, Please Check Again Promo Code');
            }

            $promo_minimum = $promo->minimal_price;
            $total_price = $request->inventory;
            $total_price = Inventory::where('id', $total_price)->first();
            $total_price = $total_price->price * $request->qty;

            if ($total_price <= $promo_minimum) {
                return back()->with('notification-danger', 'Promo Invalid, Please Check Again Promo Code, Minimum Order = ' . $promo_minimum);
            }

            if ($request->promo != null) {
                $qty = $request->qty;
                $product = Inventory::where('id', $request->inventory)->first();
                $promo = $request->promo;
                $percentage = Promo::where('code', $request->promo)->first();
                $percentage = $percentage->discount;
                $price = ($product->price * $qty)  * ($percentage / 100);
                $hasPromo = 1;
                return view('Order.invoice', compact('now', 'qty', 'product', 'promo', 'percentage', 'price', 'hasPromo', 'hidden1', 'hidden2', 'hidden3', 'hidden4'));
            }
        }
    }

    function print()
    {
        $store_id = Auth::user()->store_id;
        $order = Order::where('store_id', $store_id)->orderBy('created_at', 'DESC')->get();
        return view('Order.print', compact('order'));
    }
}
