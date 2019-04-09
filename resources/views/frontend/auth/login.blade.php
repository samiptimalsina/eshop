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
                        <button type="submit" name="" class="btn btn-default">Login</button>

                        <a href="{{ route('password.request') }}" style="margin-top: 12px;float:left;">Forgot password?</a>

                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </section><!--/form-->
@endsection()