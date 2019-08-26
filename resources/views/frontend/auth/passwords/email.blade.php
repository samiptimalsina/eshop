@extends('frontend.layouts.master')

@section('content')
    <section><!--form-->
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
            <div class="login-form"><!--login form-->

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h2>{{ __('Reset Password') }}</h2>

                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}
                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           value="{{ old('email') }}" name="email" placeholder="email" required autofocus/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                    <div class="col-sm-8"  style="padding: 0px">
                        <button type="submit" class="btn btn-primary">Send Password Reset Link </button>
                    </div>

                    <div class="col-sm-4" style="padding: 0px">
                        <a type="button" class="btn btn-primary pull-right" href="{{ route('login') }}">login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
