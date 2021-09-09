@extends('Template.template')


@section('content')
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> ELPiGO.com
                <small class="float-right">Date: {{$now}}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                @php
                $store = DB::table('stores')->where('id',Auth::user()->store_id)->first();
                @endphp
                <strong>{{$store->name}}</strong><br>
            </address>
        </div>
        <!-- /.col -->
        @if ($hidden1 == 1)
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>{{$hidden2}} - {{$hidden3}}</strong><br>
            </address>
        </div>
        @endif
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$qty}}</td>
                        <td>{{$product->name}}</td>
                        <td>@currency($product->price * $qty)</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
        </div>
        <!-- /.col -->
        <div class="col-6">

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>@currency($product->price * $qty)</td>
                        </tr>
                        @if ($hasPromo == 1)
                        <tr>
                            <th>Promo Code</th>
                            <td>{{$promo}}</td>
                        </tr>
                        <tr>
                            <th>Promo ({{$percentage}}%)</th>
                            <td>@currency($price)</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>@currency($product->price * $qty - $price)</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-12">
            <form action="/order/store" method="GET">
                @csrf
                @if ($hidden1 == 0)
                <input type="hidden" name="subsidi" value="{{$hidden1}}">
                <input type="hidden" name="inventory" value="{{$hidden2}}">
                <input type="hidden" name="qty" value="{{$hidden3}}">
                <input type="hidden" name="promo" value="{{$hidden4}}">
                @endif
                @if ($hidden1 == 1)
                <input type="hidden" name="subsidi" value="{{$hidden1}}">
                <input type="hidden" name="nik" value="{{$hidden2}}">
                <input type="hidden" name="name" value="{{$hidden3}}">
                <input type="hidden" name="inventory" value="{{$product->id}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <input type="hidden" name="qty" value="1">

                @endif
                <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
