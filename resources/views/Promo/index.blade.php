@extends('Template.template')

@section('content-header')
Promo Code
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">List Promo Code</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (Auth::user()->role == 'admin')
        <a href="/promo/create" class="btn btn-primary">Add Promo</a>
        <br> <br>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Promo Code</th>
                    <th>Discount</th>
                    <th>Minimal Order</th>
                    <th>Valid Until</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($promo as $promos)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$promos->code}}</td>
                    <td>{{$promos->discount}}%</td>
                    <td>@currency($promos->minimal_price)</td>
                    <td>{{$promos->valid_until}}</td>
                    @if (Auth::user()->role == 'admin')
                    <td style="width: 130px"><a href="promo/{{$promos->id}}/edit">Edit</a> | <a
                            href="promo/{{$promos->id}}/destroy">Delete</a></td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @empty
                <tr>
                    <td colspan="5">Promo Not Available</td>
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
