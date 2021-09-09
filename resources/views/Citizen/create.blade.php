@extends('Template.template')

@section('content-header')
Add Citizen
@endsection
@section('content')
<div class="card card-primary" style="width: 70%;margin:auto">
    <!-- form start -->
    <form action="/citizen/store" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">NIK</label>
                <input type="text" class="form-control" name="nik" id="exampleInputEmail1"
                    onkeypress="return isNumber(event)" pattern="\d{16}" title="NIK must be 16 digit"
                    placeholder="Enter NIK" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Name"
                    required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">District</label>
                <select class="form-control" name="district" required>
                    <option value="">Choice</option>
                    @foreach ($district as $districts)
                    <option value="{{$districts->id}}">{{$districts->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@section('notification')
@if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    $(document).Toasts('create', {
                    title: 'Error!!!',
                    autohide: true,
                    delay: 3000,
                    class: 'bg-danger',
                    body: '{{ $error }}'
                });
</script>
@endforeach
@endif
@endsection
