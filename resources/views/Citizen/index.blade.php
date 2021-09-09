@extends('Template.template')

@section('content-header')
Masyarakat Penerima Gas Bersubsidi
@endsection
@section('content')
<div class="card" style="width: 50%;margin:auto;">
    <div class="card-header">
        <h3 class="card-title">List Masyarakat Kurang Mampu</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (Auth::user()->role == 'admin')
        <a href="/citizen/create" class="btn btn-primary">Add Citizen</a>
        <br> <br>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Last Order</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp

                @forelse ($citizen as $citizens)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$citizens->nik}}</td>
                    <td>{{$citizens->name}}</td>
                    <td>{{$citizens->District->name}}</td>
                    <td style="color:{{$citizens->countdown >= 30 ? 'green' : 'red'}}">{{$citizens->countdown}} Days Ago
                    </td>

                    @if (Auth::user()->role == 'admin')
                    <td style="width: 130px"><a href="citizen/{{$citizens->id}}/edit">Edit</a> | <a
                            href="citizen/{{$citizens->id}}/destroy">Delete</a></td>
                    @endif
                </tr>
                @php
                $i++
                @endphp
                @empty
                <tr>
                    <td colspan="6">Data Masyarakat Kurang Mampu Empty</td>
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
