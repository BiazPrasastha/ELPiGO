@extends('Template.template')

@section('content-header')
@php
$store = DB::table('stores')->where('id',Auth::user()->store_id)->first();
@endphp
Inventory <u>{{$store->name}}</u>
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">List Inventory <u>{{$store->name}}</u></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <a href="/inventory/create" class="btn btn-primary">Add Inventory</a>
        <br> <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($inventory as $inventories)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$inventories->name}}</td>
                    <td>{{$inventories->amount}}</td>
                    <td>@currency($inventories->price)</td>
                    <td>{{$inventories->subsidi == 1 ? 'Bersubsidi' : 'Non-Subsidi'}}</td>
                    <td style="width: 130px"><a href="inventory/{{$inventories->id}}/edit">Edit</a> | <a
                            href="inventory/{{$inventories->id}}/destroy">Delete</a></td>
                </tr>
                @php
                $i++
                @endphp

                @empty
                <tr>
                    <td colspan="5">Inventory <u>{{$store->name}}</u> Data Empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection

@section('notification')
@if (Session::has('notification'))
<script>
    $(document).Toasts('create', {
                title: 'Success!!!',
                autohide: true,
                delay: 3000,
                class: 'bg-success',
                body: '{{Session::get("notification")}}'
            });
</script>
@endif
@endsection
