@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Change profile picture</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/admin/dashboard') }}">Home</a>
                </li>
                <li class="active">
                    <strong>Profile picture</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile picture</h5>
                    </div>

                    <div class="ibox-content">

                        <form method="POST" action="{{ route('admin.changeProfilePicture') }}" enctype="multipart/form-data" class="form-horizontal">
                            @csrf()

                            <div class="form-group">
                                @include("partials.flash_messages.flashMessages")
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Image<span class="required-star"> *</span></label>
                                <div class="col-lg-5">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input onchange="showMyImage(this)" required type="file" name="img"/>
                                        </span>
                                        <a onclick="removePreview()" href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-lg-2 control-label">Preview</label>
                                <div class="col-sm-2">
                                    <?php
                                        if (isset(Auth::user()->image)){
                                            $image_url = URL::to('admin/uploads/images/admins/'.Auth::user()->image);
                                        }else{
                                            $image_url = URL::to('admin/img/no-image.png');
                                        }
                                    ?>
                                    <img src="{{ $image_url }}" alt="Image" class="preview_image" id="img-preview">
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

<script>
    /*Show image preview*/
    function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var img=document.getElementById("img-preview");
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

    /*Remove image preview*/
    function removePreview() {
        var img_preview = document.getElementById("img-preview");
        img_preview.src = "<?php echo $image_url ?>";
    }
</script>
