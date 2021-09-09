@extends('Template.template')

@section('content-header')
Pembelian Gas LPG Bersubsidi
@endsection
@section('content')
<div class="row">
    <div class="col-md-8" style="margin: auto">
        <div class="card card-default">
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#data-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="data-part"
                                id="data-part-trigger">
                                <span class="bs-stepper-label">Personal Data</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <form action="/order/invoice" method="post">
                            @csrf
                            <input type="hidden" name="subsidi" value="1">
                            <div id="data-part" class="content" role="tabpanel" aria-labelledby="data-part-trigger">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        onkeypress="return isNumber(event)" pattern="\d{16}"
                                        title="NIK must be 16 digit" placeholder="Enter Your NIK, Check On Your ID Card"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Your Name, Check On Your ID Card" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
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
