<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Blank Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/template/style.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/template/bs-stepper.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>
@php
$store = DB::table('stores')->where('id',Auth::user()->store_id)->first();
@endphp
<div class="content-wrapper" style="width:100%;margin:0;padding:0">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid" style="margin: 50px auto">
            <h1 class="text-center" style="font-weight: bold">
                Sales Report <u>{{$store->name}}</u>
            </h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-bottom: 100px">
        <div class="card" style="width: 50%;margin:auto;">
            <div class="card-header">
                <h3 class="card-title">List Sales Report <u>{{$store->name}}</u></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Promo</th>
                            <th>Total Price</th>
                            <th>Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @forelse ($order as $orders)
                        <tr>
                            <td>{{$i}}</td>
                            <td style="color: {{$orders->type == 0 ? 'magenta' : 'green'}}">{{$orders->Inventory->name}}
                            </td>
                            <td>{{$orders->quantity}}</td>
                            <td>{{$orders->promo_id == null ? '-' : $orders->Promo->code}}</td>
                            <td>@currency($orders->total_price)</td>
                            <td>{{$orders->created_at}}</td>
                        </tr>
                        @php
                        $i++
                        @endphp

                        @empty
                        <tr>
                            <td colspan="6">Data Sales Report <u>{{$store->name}}</u> Empty</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/template/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/template/demo.js')}}"></script>
<script src="{{asset('js/template/bs-stepper.min.js')}}"></script>
@yield('notification');
<script>
    window.print();
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    $(document).ready(function(){
		$('.number').prop('disabled', true);
        $(document).on('click','.plus',function(){
				$('.number').val(parseInt($('.number').val()) + 1 );
        });
        $(document).on('click','.minus',function(){
            $('.number').val(parseInt($('.number').val()) - 1 );
            if ($('.number').val() == 0) {
				$('.number').val(1);
			}
        });
    });
    function isNumber(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>
</body>

</html>
