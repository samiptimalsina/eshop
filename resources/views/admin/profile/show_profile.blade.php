@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>My Profile</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin/dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>Profile</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>My profile</h5>
                    </div>

                    <div class="ibox-content">

                        <form method="POST" action="{{ route('admin.profile') }}" class="form-horizontal">
                            @csrf()

                            <div class="form-group">
                                @include("partials.flash_messages.flashMessages")
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Name<span class="required-star"> *</span></label>
                                <div class="col-lg-10"><input value="{{ Auth::user()->name }}" required="required" name="name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Email Address<span class="required-star"> *</span></label>
                                <div class="col-lg-10">
                                    <input readonly type="email" class="form-control span6 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{Auth::user()->email }}" name="email" placeholder="email" required />
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Phone No</label>
                                <div class="col-lg-10"><input value="{{ Auth::user()->phone }}" name="phone" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Address Line 1</label>
                                <div class="col-lg-10"><input value="{{ Auth::user()->address_line1 }}" name="address_line1" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Address Line 2</label>
                                <div class="col-lg-10"><input value="{{ Auth::user()->address_line2 }}" name="address_line2" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-warning t m-t-n-xs"><strong>Cancel</strong></a>
                                    <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Update</strong></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
