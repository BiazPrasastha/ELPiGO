@include('Template.header')
@include('Template.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid" style="margin: 50px auto">
            <h1 class="text-center" style="font-weight: bold">
                @yield('content-header')
            </h1>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" style="padding-bottom: 100px">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@include('Template.footer')
