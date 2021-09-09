@extends('Template.template')

@section('content-header')
Add Inventory
@endsection
@section('content')
<div class="card card-primary" style="width: 70%;margin:auto">
    <!-- form start -->
    <form action="/inventory/{{$id->id}}/update" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter LPG Type"
                    value="{{$id->name}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Amount</label>
                <input type="number" class="form-control" name="amount" id="exampleInputEmail1"
                    placeholder="Enter LPG Amount" value="{{$id->amount}}" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control" name="price" value="{{$id->price}}" required>
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="subsidi" value="1" type="checkbox"
                        {{$id->subsidi == 1 ? 'checked' : ''}} required>
                    <label class="form-check-label">Subsidi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="subsidi" value="0" type="checkbox"
                        {{$id->subsidi == 0 ? 'checked' : ''}} required>
                    <label class="form-check-label">Non-Subsidi</label>
                </div>
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
@if (Session::has('notification-danger'))
<script>
    $(document).Toasts('create', {
                title: 'Error!!!',
                autohide: true,
                delay: 3000,
                class: 'bg-danger',
                body: '{{Session::get("notification-danger")}}'
            });
</script>
@endif
@endsection
