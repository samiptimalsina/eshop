@extends('frontend.layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4" style="border: 1px solid #eee; padding-bottom: 30px">
            <div class="login-form"><!--login form-->

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h2>{{ __('Reset Password') }}</h2>
                <form class="form-horizontal" action="{{ route('password.request') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-prepend" title="Email">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" placeholder="Email" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Password">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    placeholder="Password" required autofocus>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        <div class="clearfix"></div>

                        <div class="input-prepend" title="Confirm Password">
                            <span class="add-on"><i class="halflings-icon user"></i></span>
                            <input id="password-confirm" type="password"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation"
                                  placeholder="Confirm Password" required autofocus>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                        <div class="clearfix"></div>

                    <div class="col-sm-8"  style="padding: 0px">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>

                    <div class="col-sm-4" style="padding: 0px">
                        <a type="button" class="btn btn-primary pull-right" href="{{ route('login') }}">login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
