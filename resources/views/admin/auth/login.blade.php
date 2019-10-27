@extends('admin.auth.layouts.app')

@section('content')

    @include('partials.flash_messages.flashMessages')

    <div>
        <h1 class="logo-name">ES+</h1>
    </div>
    <div style="color: #E6E6E6">
        <h3>Welcome to E-Shopper</h3>
        <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
        </p>
        <p>Login in. To see it in action.</p>
    </div>
    <form class="m-t" role="form" action="{{ route('admin.login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="aalmamun417@gmail.com" placeholder="aalmamun417@gmail.com" required autofocus>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <input id="password" value="12345678" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="12345678" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        {{--<div class="col-lg-offset-2 col-lg-10">
            <div class="i-checks"><label> <input name="remember" {{ old('remember') ? 'checked' : '' }} id="remember" type="checkbox"><i></i> Remember me </label></div>
        </div>--}}

        <input name="grecaptcha_token" id="grecaptcha_token" type="hidden">

        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

        <a href="{{ route('admin.password.request') }}">
            <small>Forgot password?</small>
        </a>
    </form>

@endsection()

@section('custom-js')
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcSuL8UAAAAAOuP9CVtkVU97_3a2pan2P19vtZB', {action: 'homepage'}).then(function(token) {
                document.getElementById('grecaptcha_token').value = token;
            });
        });
    </script>
@endsection