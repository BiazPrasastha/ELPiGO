@extends('Template.template')

@section('content-header')
Add District
@endsection
@section('content')
<div class="card card-primary" style="width: 70%;margin:auto">
    <!-- form start -->
    <form action="/district/store" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">District Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                    placeholder="Enter District Name" oninput="this.value = this.value.toUpperCase()" required>
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
