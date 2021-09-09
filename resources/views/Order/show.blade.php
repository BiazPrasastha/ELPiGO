@extends('Template.template')

@section('content-header')
@php
$store = DB::table('stores')->where('id',Auth::user()->store_id)->first();
@endphp
Sales Report <u>{{$store->name}}</u>
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">List Sales Report <u>{{$store->name}}</u></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <a href="/report/print" class="btn btn-warning">Print PDF</a>
        <br> <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Promo</th>
                    <th>Total Price</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($order as $orders)
                <tr>
                    <td>{{$i}}</td>
                    <td style="color: {{$orders->type == 0 ? 'magenta' : 'green'}}">{{$orders->Inventory->name}}</td>
                    <td>{{$orders->quantity}}</td>
                    <td>{{$orders->promo_id == null ? '-' : $orders->Promo->code}}</td>
                    <td>@currency($orders->total_price)</td>
                    <td>{{$orders->created_at}}</td>
                </tr>
                @php
                $i++
                @endphp

                @empty
                <tr>
                    <td colspan="6">Data Sales Report <u>{{$store->name}}</u> Empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection
