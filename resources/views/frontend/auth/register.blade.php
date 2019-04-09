@extends('frontend.layouts.master')

@section('content')
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Register!</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="name" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif

                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>

                        <button type="submit" class="btn btn-default">Register</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
@endsection()