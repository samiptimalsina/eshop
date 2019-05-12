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

    <div id="root" class="row my-account">

        @include("partials.flash_messages.flashMessages")

        <!-- Sidebar -->
        <div class="col-sm-3">
            <aside class="sidebar">
                <div class="sidebar__info">
                    <div class="sidebar__info--thumbnail">
                        <img class="img-fluid rounded-circle" :src="'{{ URL::to('public/admin/uploads/images/users') }}/'+personal_info.image" alt="" width="50px">
                    </div>
                    <div class="sidebar__info--content">
                        <p>Hello,</p>
                        <h3>@{{ personal_info.name }}</h3>
                    </div>
                </div>

                <ul class="sidebar__menu">
                    <li class="active">
                        <a href="{{ route('user.myProfile') }}">My Profile</a>
                    </li>
                    <li>
                        <a href="#0">My Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}">My Cart</a>
                    </li>
                    <li>
                        <a href="{{ route('wishlist.index') }}">My Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>

                    </li>
                </ul>
            </aside>
        </div>
        <!-- Main Content -->
        <div class="col-sm-9 bg-white border shadow-sm pt-4 pb-4 pl-5 pr-5 mb-3">
            <div class="heading border-bottom pb-4">
                <span class="text">Personal Information</span>
                <span id="pInfoEdit" class="edit1 ml-4" @click="personalInfoEdit">Edit</span>

            </div>
            <form @submit.prevent="updateUserInfo" id="p-info-form" method="POST" action="{{ route('user.myProfile') }}" class="mt-4">
                @csrf

                <div class="form-group ">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name" class="form-label pb-1">Name</label>
                            <input v-model="personal_info.name" type="text" class="form-control personal p-3 name {{ $errors->has('name') ? ' is-invalid' : '' }}" disabled="disabled">
                        </div>
                        <div class="col-sm-6">
                            <label for="name" class="form-label pb-1">Mobile Number</label>
                            <input v-model="personal_info.phone" type="text" class="form-control personal p-3 phone {{ $errors->has('phone') ? ' is-invalid' : '' }}" disabled="disabled">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form-label pb-1">Email Address</label>
                                <input v-model="personal_info.email" type="email" class="form-control personal p-3 {{ $errors->has('email') ? ' is-invalid' : '' }}" disabled="disabled">
                        </div>

                        <div class="col-sm-6">
                            <label for="email" class="form-label pb-1">Address Line 1</label>
                            <input v-model="personal_info.address_line1" type="text" class="form-control personal p-3" disabled="disabled">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="dob" class="form-label pb-1">Your Date of Birth</label>
                            <input v-model="personal_info.date_of_birth" type="date" class="form-control personal p-3 date-of-birth" disabled="disabled">
                        </div>

                        <div class="col-sm-6">
                            <label for="dob" class="form-label pb-1">Address Line 2</label>
                            <input v-model="personal_info.address_line2" type="text" class="form-control personal p-3 date-of-birth" disabled="disabled">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">

                            <label for="gender" class="form-label pb-1">Gender</label>

                            <div>
                                <label class="custom-radio">Male
                                    <input type="radio" v-model="personal_info.gender" value="male" class="custom-control-input personal" disabled="disabled">
                                    <span class="checkmark"></span>
                                </label>

                                <label class="custom-radio">Female
                                    <input type="radio" v-model="personal_info.gender" value="female" class="custom-control-input personal" disabled="disabled">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <input id="p-info-update-btn" type="submit" class="hidden btn btn-active text-light font-weight-bold pl-4 pr-4 mt-2" value="Save">
                <span id="user-info-change-msg" class="msg1 text-success ml-4"></span>
            </form>

            <div class="heading border-top border-bottom pb-4 pt-4 mt-4">
                <span class="text">Profile Picture</span>
                <span id="imageEdit" class="edit2 ml-4" @click="imageEdit">Change Profile Picture</span>
                <p><small>(PNG/JPG/JPEG/BMP, Max. 3MB)</small></p>
            </div>

            <form @submit.prevent="uploadProfileImage" action="{{ route('user.imageUpload') }}" method="post" enctype="multipart/form-data" id="change-profile-image">
                @csrf

                <div class="form-group">
                    <p class="form-label mt-3 mb-3">Your Profile Photo</p>

                    <?php
                        if (isset(Auth::user()->image)){
                            $image_url = URL::to('public/admin/uploads/images/users/'.Auth::user()->image);
                        }else{
                            $image_url = URL::to('public/admin/img/no-image.png');
                        }
                    ?>

                    <img class="img-fluid rounded-circle userImage" id="uploadImage" src="{{ $image_url }}" width="100px" alt="profile_image">
                    <input type="file" class="image ml-5 pt-2 pb-2 pl-4 pr-4 imageChangeHf hidden" @change="onImageChange" onchange="showMyImage(this)" style="display: inline-block">
                </div>
                <input type="submit" class="btn btn-active text-light font-weight-bold pl-4 pr-4 mt-2 imageChangeHf hidden" value="Save">
                <span id="imageChangeMsg" class="msg2 text-success ml-4"></span>
            </form>
            <div class="heading border-top border-bottom pb-4 pt-4 mt-4">
                <span class="text">Password</span>
                <span id="changePassword" class="edit3 ml-4" @click="passwordEdit">Change Password</span>
            </div>
            <form @submit.prevent="updatePassword" action="{{ route('user.updatePassword') }}" method="post" class="mt-3">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">Your Current Password</label>
                            <input v-model="change_password.old_password" v-validate="'required'" type="password" data-vv-as="current password" name="old_password" id="oldPwd" class="form-control password p-3" disabled="">
                            <span v-show="errors.has('old_password')" class="help text-danger">@{{ errors.first('old_password') }}</span>
                        </div>
                    </div>
                    <div class="row reset mt-4 changePasswordHf hidden">
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">New Password</label>
                            <input v-model="change_password.password" v-validate="'required|min:6'" :class="{'text-danger': errors.has('password')}" ref="password" type="password" name="password" id="newPwd" class="form-control password p-3">
                            <span v-show="errors.has('password')" class="help text-danger">@{{ errors.first('password') }}</span>
                        </div>
                        <div class="col-sm-6">
                            <label for="password" class="form-label pb-1">Confirm Password</label>
                            <input v-model="change_password.password_confirmation" v-validate="'required|confirmed:password'" :class="{'text-danger': errors.has('password_confirmation')}" data-vv-as="confirm password" type="password" name="password_confirmation" id="confirmPwd" class="form-control password p-3">
                            <span v-show="errors.has('password_confirmation')" class="help text-danger">@{{ errors.first('password_confirmation') }}</span>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-active text-light font-weight-bold pr-4 pl-4 mt-2 changePasswordHf hidden" id="passwordInfo" value="Save">
                <span id="passwordChangeMsg" class="msg2 text-success ml-4"></span>
            </form>
        </div>
    </div>

    <script>

        /*Show image preview*/
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var img=document.getElementById("uploadImage");
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function(img) {
                    return function(e) {
                        img.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }

        Vue.use(VeeValidate);

        var MyProfile = new Vue({
            el: "#root",
            data: {
                personal_info: {
                    name: '',
                    phone: '',
                    email: '',
                    address_line1: '',
                    date_of_birth: '',
                    address_line2: '',
                    gender: '',
                },

                profile_image: {
                        img: ''
                },
                
                change_password:{
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                }

            },

            mounted() {
                this.preFilledProfileInfo();
            },

            methods:{

                //Start personal information
                preFilledProfileInfo(){
                    axios.get(home_url + '/my-profile/get-info')
                        .then(response => {
                            this.personal_info = response.data;
                        });
                },

                personalInfoEdit(){

                    $(".personal").each(function () {
                        $(this).removeAttr('disabled');
                    });

                    $('#pInfoEdit').addClass('hidden');
                    $('#p-info-update-btn').removeClass('hidden');
                },

                updateUserInfo(e){
                    $('#user-info-change-msg').removeAttr('style');
                    path = e.currentTarget.getAttribute('action');

                    axios.post(path, this.personal_info)
                        .then(response => {

                            if (errors = response.data.errors){
                                this.showErrorMessage($('#user-info-change-msg'));
                            }else { // success
                                message = response.data.success;
                                this.showSuccessMessage($('#user-info-change-msg'))
                            }
                        });

                    this.messageFadeOut($("#user-info-change-msg"));
                },
                //End personal information

                //Start profile image
                imageEdit(){
                    $('#imageEdit').addClass('hidden');

                    $('.imageChangeHf').each(function () {
                        $(this).removeClass('hidden');
                    });
                },

                onImageChange(e){
                    this.profile_image.img = e.target.files[0];
                },

                uploadProfileImage(e){
                    $('#imageChangeMsg').removeAttr('style');
                    path = e.currentTarget.getAttribute('action');

                    let formData = new FormData();
                    formData.append('img', this.profile_image.img);

                    axios.post(path, formData)
                        .then(response => {

                            if (errors = response.data.errors){
                                this.showErrorMessage($('#imageChangeMsg'));
                            }else { // success
                                message = response.data.success;
                                this.showSuccessMessage($('#imageChangeMsg'))
                            }
                        });

                    this.messageFadeOut($("#imageChangeMsg"));
                },
                //End personal image


                //Start change password
                passwordEdit(){
                    $('#oldPwd').removeAttr('disabled');
                    $('#changePassword').addClass('hidden');

                    $('.changePasswordHf').each(function () {
                       $(this).removeClass('hidden')
                    });
                },

                updatePassword(e){
                    this.$validator.validate().then(valid => {
                        if (valid) {
                            
                            $('#passwordChangeMsg').removeAttr('style');
                            path = e.currentTarget.getAttribute('action');

                            axios.post(path, this.change_password)
                                .then(response => {

                                    if (errors = response.data.errors){
                                        this.showErrorMessage($('#passwordChangeMsg'));
                                    }else { // success
                                        message = response.data.success;
                                        this.showSuccessMessage($('#passwordChangeMsg'))
                                    }
                                });

                            this.messageFadeOut($("#passwordChangeMsg"));
                        }
                    });
                },
                //End change password

                showSuccessMessage(messageId){
                    messageId.removeClass('text-danger');
                    messageId.html(message);
                },

                showErrorMessage(messageId){
                    messageId.addClass('text-danger');
                    messageId.html(errors);
                },

                messageFadeOut(messageId){
                    window.setTimeout(function() {
                        messageId.fadeOut('slow', function() {
                            messageId.html('');
                        });
                    }, 3000);
                }
            }
        })
    </script>

@endsection()