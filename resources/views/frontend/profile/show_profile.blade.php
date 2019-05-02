@extends('frontend.layouts.master')

@section('content')
    {{--<div class="row">

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
    </div>--}}

    <div class="row my-account">

        <!-- Sidebar -->
        <div class="col-sm-3">
            <aside class="sidebar">
                <div class="sidebar__info">
                    <div class="sidebar__info--thumbnail">
                        <img class="img-fluid rounded-circle" src="https://s3-ap-southeast-1.amazonaws.com/rokomari110/user/9f86c62108cb4_284632.jpg" alt="" width="50px">
                    </div>
                    <div class="sidebar__info--content">
                        <p>Hello,</p>
                        <h3>Abdullah al mamun</h3>
                    </div>
                </div>

                <ul class="sidebar__menu">
                    <li class="active">
                        <a href="/my-section/profile">My Accounts</a>
                    </li>
                    <li>
                        <a href="/my-section/orders">My Orders</a>
                    </li>
                    <li>
                        <a href="/my-section/list">My Lists</a>
                    </li>
                    <li>
                        <a href="/my-section/wish-list">My Wishlist</a>
                    </li>
                    <li>
                        <a href="/my-section/wallet">My Wallet</a>
                    </li>
                    <li>
                        <a href="/ordertrack">My Order Track</a>
                    </li>
                    <li>
                        <a href="/loadgiftvoucher">Load Gift Voucher</a>
                    </li>
                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="col-sm-9 bg-white border shadow-sm pt-4 pb-4 pl-5 pr-5">
            <div class="heading border-bottom pb-4">
                <span class="text">Personal Information</span>
                <span class="edit1 ml-4" onclick="personalInfoEdit()">Edit</span>

            </div>
            <form action="" class="mt-4">
                <div class="form-group ">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name" class="form-label pb-1">Name</label>
                            <input type="text" name="name" class="form-control personal p-3 name" value="Abdullah al mamun" disabled="">
                        </div>
                        <div class="col-sm-6">
                            <label for="name" class="form-label pb-1">Mobile Number</label>
                            <input type="text" name="phone" class="form-control personal p-3 phone" value="01750800764" disabled="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form-label pb-1">Email Address</label>
                            <input type="email" name="email" class="form-control p-3" value="aalmamun417@gmail.com" disabled="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="dob" class="form-label pb-1">Your Date of Birth</label>
                            <input type="date" name="dob" class="form-control personal p-3 date-of-birth" value="" disabled="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="gender" class="form-label pb-1">Gender</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" value="male" id="customRadioInline1" name="gender" class="custom-control-input personal" disabled="" checked="checked">
                        <label class="custom-control-label" for="customRadioInline1">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" value="female" id="customRadioInline2" name="gender" class="custom-control-input personal" disabled="">
                        <label class="custom-control-label" for="customRadioInline2">Female</label>
                    </div>
                </div>
                <input type="button" onclick="updateUserInfo()" class="btn btn-active text-light font-weight-bold pl-4 pr-4 mt-2" id="personalInfo" value="Save">
                <span id="userInfoChangeMsg" class="msg1 text-success ml-4" style="display: none;"></span>
                <input type="hidden" name="_tk" id="_tk" value="pe_wKNiNP2UXVhwbTiluWgAoqgDV4LfQRrYPq_n1RzA">
            </form>
            <div class="heading border-top border-bottom pb-4 pt-4 mt-4">
                <span class="text">Profile Picture</span>
                <span class="edit2 ml-4" onclick="imageEdit()">Change Profile Picture</span>
                <p><small>(PNG/JPG/JPEG/BMP, Max. 3MB)</small></p>
            </div>
            <form action="" enctype="multipart/form-data" id="change-profile-image">
                <div class="form-group">
                    <p class="form-label mt-3 mb-3">Your Profile Photo</p>
                    <img class="img-fluid rounded-circle userImage" id="uploadImage" src="https://s3-ap-southeast-1.amazonaws.com/rokomari110/user/9f86c62108cb4_284632.jpg" width="100px" alt="profile_image">
                    <input type="file" class="image ml-5 pt-2 pb-2 pl-4 pr-4" name="profileImage" id="photo" onchange="previewImage()" style="display: inline-block">
                    <input type="hidden" name="x1" id="x1">
                    <input type="hidden" name="x2" id="x2">
                    <input type="hidden" name="y1" id="y1">
                    <input type="hidden" name="y2" id="y2">
                </div>
                <input type="button" onclick="uploadProfileImage()" class="btn btn-active text-light font-weight-bold pl-4 pr-4 mt-2" id="imageInfo" value="Save">
                <span id="imageChangeMsg" class="msg2 text-success ml-4" style="display: none;"></span>
                <input type="hidden" name="_tk" id="_tk" value="pe_wKNiNP2UXVhwbTiluWgAoqgDV4LfQRrYPq_n1RzA">
            </form>
            <div class="heading border-top border-bottom pb-4 pt-4 mt-4">
                <span class="text">Password</span>
                <span class="edit3 ml-4" onclick="passwordEdit()">Change Password</span>
                <!-- <span class="msg3 text-success ml-4">Info Successfully Saved</span> -->
            </div>
            <form action="" class="mt-3">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">Your Current Password</label>
                            <input type="password" name="oldPassword" id="oldPwd" class="form-control password p-3" value="**********" disabled="">
                        </div>
                    </div>
                    <div class="row reset mt-4">
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">New Password</label>
                            <input type="password" name="password" id="newPwd" class="form-control password new p-3" disabled="">
                        </div>
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">Confirm Password</label>
                            <input type="password" name="reTypePassword" id="renewPwd" class="form-control password confirm p-3" disabled="">
                        </div>
                    </div>
                    <div class="error text-danger font-italic mt-3" style="display: none;">* Password doesn't match</div>
                </div>
                <input class="btn btn-active text-light font-weight-bold pr-4 pl-4 mt-2" id="passwordInfo" type="button" onclick="changePass()" value="Save">
                <span id="editPassword"></span>
            </form>
        </div>
    </div>

@endsection()