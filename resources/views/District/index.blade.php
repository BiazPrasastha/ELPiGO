@extends('Template.template')

@section('content-header')
District
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">District List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (Auth::user()->role == 'admin')
        <a href="/district/create" class="btn btn-primary">Add District</a>
        <br> <br>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($district as $districts)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$districts->name}}</td>
                    @if (Auth::user()->role == 'admin')
                    <td style="width: 130px"><a href="district/{{$districts->id}}/edit">Edit</a> | <a
                            href="district/{{$districts->id}}/destroy">Delete</a></td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @empty
                <tr>
                    <td colspan="3">District Data Empty</td>
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
