<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-SHOPPER</title>

    {{--Quick view--}}
    <link href="{{ asset('public/frontend/css/plugins/quickView/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/plugins/quickView/style.css') }}" rel="stylesheet">
    <script src="{{ asset('public/frontend/js/plugins/quickView/modernizr.js') }}"></script>

    <link href="{{ asset('public/frontend/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{ asset('public/frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/zoomple.css') }}" rel="stylesheet">

    <link href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Ladda style -->
    <link href="{{ asset('public/frontend/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">

    {{--Toastr--}}
    <link href="{{ asset('public/admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <script type="text/javascript">var home_url="{{ url('/') }}"</script>
    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>

    {{--range--}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{--rate--}}
    <link href="{{ asset('public/frontend/css/plugins/rate/jquery.rateyo.min.css') }}" rel="stylesheet">

    {{--vueJs--}}
    <script src="{{ asset('public/frontend/js/vue/vue.js') }}"></script>
    <script src="{{ asset('public/frontend/js/axios/axios.js') }}"></script>

    {{--custom--}}
    <script src="{{ asset('public/frontend/js/custom.js') }}"></script>

    <link rel="icon" type="image/png" href="{{ asset('public/frontend/images/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ asset('public/frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="{{ asset('public/frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="{{ asset('public/frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
          href="{{ asset('public/frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">

</head><!--/head-->

<body>
<header id="header"><!--header-->

    <div class="alert alert-warning fade in" style=" padding: 0;text-align: center;margin: 0;">
        <strong>Warning!</strong> This project is developing till now.
    </div>

    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle" id="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src="{{ asset('public/frontend/images/home/logo.png') }}" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav"> {{--currentController() from common helper--}}
                            <li><a class="<?php if (currentController() == "HomeController"){ echo "active";} ?>"  href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li>
                                <a class="<?php if (currentController() == "WishListsController"){ echo "active";} ?>" href="{{ route('wishlist.index') }}"><i class="fa fa-star"></i>
                                    Wishlist
                                    @php($wishlist_count = Count(Cart::instance('wishlist')->content()))
                                    <span class="{{ $wishlist_count>0?'counter':'' }}" id="wishlist-counter"> {{ $wishlist_count>0?$wishlist_count:'' }} </span>
                                </a>
                            </li>
                            <li><a class="<?php if (currentController() == "CheckoutsController"){ echo "active";} ?>" href="{{ route('checkout') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a class="<?php if (currentController() == "CartsController"){ echo "active";} ?>" href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>
                                    Cart
                                    @php($cart_count = Count(Cart::instance('cart')->content()))
                                   <span class="{{ $cart_count>0?'counter':'' }}" id="cart-counter"> {{ $cart_count>0?$cart_count:'' }} </span></a>
                            </li>

                            @guest
                                <li><a href="{{ route('login') }}" class="<?php if (currentController() == "LoginController"){ echo "active";} ?>"><i class="fa fa-lock"></i> Login </a></li>
                                <li><a href="{{ route('register') }}" class="<?php if (currentController() == "RegisterController"){ echo "active";} ?>"><i class="fa fa-lock"></i> Registration </a></li>
                            @else

                                <li class="dropdown"><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{route('user.myProfile')}}">My Profile</a></li>
                                        <li><a href="{{ route('user.changePassword') }}">Change Password</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                            @endguest

                            <li><a class="<?php if (currentController() == "ContactsController"){ echo "active";} ?>" href="{{ route('contact') }}"><i class="fa fa-comment"></i> Contact </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->
</header><!--/header-->