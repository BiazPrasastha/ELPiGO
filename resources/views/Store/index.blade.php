@extends('Template.template')

@section('content-header')
Store ELPiGO Member
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">List Store ELPiGO Member</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Store Name</th>
                    <th>Owner</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($store as $stores)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$stores->name}}</td>
                    <td>{{$stores->owner}}</td>
                </tr>
                @php
                $i++
                @endphp
                @empty
                <tr>
                    <td colspan="2">Store Data Empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection
