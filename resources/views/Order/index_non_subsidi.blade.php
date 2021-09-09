@extends('Template.template')

@section('content-header')
Pembelian Gas LPG Non Subsidi
@endsection
@section('content')
<div class="row">
    <div class="col-md-8" style="margin: auto">
        <div class="card card-default">
            <div class="card-body p-0">
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#product-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="product-part"
                                id="product-part-trigger">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Pick Product</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#promo-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="promo-part"
                                id="promo-part-trigger">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Promo Code</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <form action="/order/invoice" method="post">
                            <div id="product-part" class="content" role="tabpanel"
                                aria-labelledby="product-part-trigger">
                                @csrf
                                <input type="hidden" name="subsidi" value="0">

                                <div class="form-group">
                                    <label for="exampleInputFile">Product Type</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Product</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="inventory">
                                            <option value="" selected>Choose...</option>
                                            @foreach ($product as $products)
                                            <option value="{{$products->id}}">{{$products->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Quantity</label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" value="1"
                                            style="width: 50px;text-align:center;padding:0;margin:0;border:none"
                                            name="qty">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>
                            <div id="promo-part" class="content" role="tabpanel" aria-labelledby="promo-part-trigger">
                                <div class="form-group">
                                    <label for="exampleInputFile">Promo Code</label>
                                    <input type="text" class="form-control" id="nik" name="promo"
                                        placeholder="Enter Promo Code">
                                </div>
                                <button type="button" class="btn btn-primary"
                                    onclick="stepper.previous()">Previous</button>
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
