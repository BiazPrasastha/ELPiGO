@extends('Template.template')

@section('content-header')
Edit Promo
@endsection
@section('content')
<div class="card card-primary" style="width: 70%;margin:auto">
    <!-- form start -->
    <form action="/promo/{{$id->id}}/update" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Promo Code</label>
                <input type="text" class="form-control" name="code" id="exampleInputEmail1"
                    placeholder="Enter Promo Code" oninput="this.value = this.value.toUpperCase()" value="{{$id->code}}"
                    required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Discount</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="discount" id="exampleInputEmail1"
                        placeholder="Enter Discount in Percentage" value="{{$id->discount}}" required>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Minimal Order</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" class="form-control" name="minimal_price" value="{{$id->minimal_price}}"
                        required>
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Valid Until</label>
                <input type="date" class="form-control" name="valid" value="{{$id->valid_until}}" required>

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
