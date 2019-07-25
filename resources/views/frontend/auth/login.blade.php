@extends('frontend.layouts.master')

@section('content')
    <section><!--form-->
        <div class="row">

            @include("partials.flash_messages.flashMessages")

            <div class="col-sm-offset-4 col-sm-4">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{ url('/login') }}" method="post">
                        {{ csrf_field() }}
                        <input type="email" name="email" placeholder="Email Address" />
                        <input type="password" name="password" placeholder="password" />

                        <div class="row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-default" style="margin: 0">Login</button>
                            </div>
                            <div class="col-sm-9">
                                <a href="{{ url('login/facebook') }}" class="btn btn-success"><i class="fa fa-facebook"></i> Login with facebook</a>
                            </div>
                        </div>

                        <a href="{{ route('password.request') }}" style="margin-top: 12px;float:left;">Forgot password?</a>

                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </section><!--/form-->
@endsection()