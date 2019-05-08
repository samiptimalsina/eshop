@extends('frontend.layouts.master')

@section('content')
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Change Password</h2>
                    <form method="POST" action="{{ route('user.updatePassword') }}">
                        @csrf

                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>

                        <button type="submit" class="btn btn-default">Update</button>

                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
@endsection()