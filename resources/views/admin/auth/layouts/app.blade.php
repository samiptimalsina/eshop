<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>E-SHOPPER | Login</title>

        <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

        {{--particle--}}
        <link href="{{ asset('admin/css/plugins/particle/style.css') }}" rel="stylesheet">

        <link href="{{ asset('admin/css/custom_style.css') }}" rel="stylesheet">

        {{--google recaptcha--}}
        <script src="https://www.google.com/recaptcha/api.js?render=6LcSuL8UAAAAAOuP9CVtkVU97_3a2pan2P19vtZB"></script>

    </head>

    <body id="particles-js" class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div style="position: absolute; padding-top: 40px">
                @yield('content')
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="{{ asset('admin/js/jquery-3.1.1.min.js') }} "></script>
        <script src="{{ asset('admin/js/bootstrap.min.js') }} "></script>

        {{--particle--}}
        <script src="{{ asset('admin/js/plugins/particle/particles.js') }}"></script>
        <script src="{{ asset('admin/js/plugins/particle/app.js') }}"></script>

        <!-- iCheck -->
        <script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

        @yield('custom-js')

    </body>

</html>
