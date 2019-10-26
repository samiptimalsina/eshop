@extends('admin.auth.layouts.app')

@section('content')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="" style="margin-bottom: 20px"></div>

        <div class="ibox-content">
            <h2 class="font-bold">Forgot password</h2>
            <p>Enter your email address and your password will be reset and emailed to you.</p>

            <form class="m-t" role="form" action="{{ route('admin.password.email') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                           value="{{ old('email') }}" placeholder="Email address" required autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Send new password link</button>

            </form>
        </div>


@endsection
