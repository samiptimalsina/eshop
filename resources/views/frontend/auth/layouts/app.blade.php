<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:57:00 GMT -->
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Metro Admin Template - Metro UI Style Bootstrap Admin Template</title>
    <meta name="description" content="Metro Admin Template.">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword"
          content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{ asset('public/backend/css/custom_style.css') }}" rel="stylesheet">
    <link id="bootstrap-style" href="{{ asset('admin') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link id="base-style" href="{{ asset('public/backend/css/style.css') }}" rel="stylesheet">
    <link id="base-style-responsive" href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext'
          rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/img/favicon.ico') }}">
    <!-- end: Favicon -->

    <style type="text/css">
        body {
            background: url({{ asset('public/backend/img/bg-login.jpg') }}) !important;
        }
    </style>

</head>
<body>

@yield('content');

<!-- start: JavaScript-->

<script src="{{ asset('public/backend/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery-migrate-1.0.0.min.js') }}"></script>
<script src="{{ asset('public/backend/js/jquery-ui-1.10.0.custom.min.js') }}"></script>
<script src="{{ asset('admin') }}"></script>
<script src="{{ asset('public/backend/js/jquery.cleditor.min.js') }}"></script>
<script src="{{ asset('public/backend/js/custom.js') }}"></script>
<!-- end: JavaScript-->

</body>

<!-- Mirrored from bootstrapmaster.com/live/metro/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:57:01 GMT -->
</html>
