<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.7
*
-->

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>E-SHOPPER | Dashboard</title>

    <link href="{{ asset('public/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('public/admin/css/custom_style.css') }}" rel="stylesheet">


</head>

<body>

<div id="wrapper">

    @include('admin.elements.sidebar')

    <div id="page-wrapper" class="gray-bg dashbard-1">

        @include('admin.elements.header')

        @yield('content')

        @include('admin.elements.footer')

    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('public/admin/js/jquery-3.1.1.min.js') }} "></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }} "></script>

<script src="{{ asset('public/admin/js/plugins/metisMenu/jquery.metisMenu.js') }} "></script>
<script src="{{ asset('public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }} "></script>
<script src="{{ asset('public/admin/js/plugins/dataTables/datatables.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('public/admin/js/inspinia.js') }} "></script>
<script src="{{ asset('public/admin/js/plugins/pace/pace.min.js') }} "></script>
<script src="{{ asset('public/admin/js/plugins/jasny/jasny-bootstrap.min.js') }} "></script>

{{--slugify--}}
<script src="{{ asset('public/admin/js/plugins/slug/jquery.slugify.js') }}"></script>

{{--i-check--}}
<script src="{{ asset('public/admin/js/plugins/iCheck/icheck.min.js') }}"></script>

<script>
    $(document).ready(function(){

        //slugify......
        $('#slug').slugify('#slug-source');

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

    /*i-check*/
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

</script>


</body>

</html>

