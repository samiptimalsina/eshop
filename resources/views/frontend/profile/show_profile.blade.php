@extends('frontend.layouts.master')

@section('content')
    <div class="row">

        @include("partials.flash_messages.flashMessages")

        <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
            <div class="signup-form"><!--sign up form-->
                <h2>My Profile</h2>
                <form method="POST" action="{{ route('user.myProfile') }}">
                    @csrf

                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" placeholder="Name" required autofocus>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" placeholder="Email" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone">

                    <input id="address_line1" type="text" class="form-control" name="address_line1" value="{{ Auth::user()->address_line1 }}" placeholder="Address line 1">

                    <input id="address_line2" type="text" class="form-control" name="address_line2" value="{{ Auth::user()->address_line2 }}" placeholder="Address line2">

                    <button type="submit" class="btn btn-default">Update</button>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
@endsection()