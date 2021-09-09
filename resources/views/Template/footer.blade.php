<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://github.com/BiazPrasastha">Biaz Prasastha</a>.</strong> All
    rights
    reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
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
