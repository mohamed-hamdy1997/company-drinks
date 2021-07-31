@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block text-right" role="alert">
        <button type="button" onclick="closeAlert()" class="close float-left" data-dismiss="alert" >×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block text-right">
        <button type="button" onclick="closeAlert()" class="close float-left" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block text-right">
        <button onclick="closeAlert()" type="button" class="close float-left" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block text-right">
        <button onclick="closeAlert()" type="button" class="close float-left" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
{{--    <div class="alert alert-danger">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        Check the following errors :(--}}
{{--    </div>--}}
@endif


<script>
    function closeAlert() {
        var all = document.getElementsByClassName('alert');
        for (var i = 0; i < all.length; i++) {
            all[i].style.display = 'none';
        }
    }
</script>
