
@include('partials.flash_messages.flashMessages')

<div class="form-group"><label class="col-lg-2 control-label">Name<span class="required-star"> *</span></label>
    <div class="col-lg-10"><input value="{{ isset($category->name) ? $category->name:'' }}" id="slug-source" required="required" name="name" type="text" class="form-control">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Slug<span class="required-star"> *</span></label>
    <div class="col-lg-10"><input value="{{ isset($category->slug) ? $category->slug:'' }}" id="slug" readonly="readonly" style="cursor: not-allowed" required="required" name="slug" type="text" class="form-control">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Description</label>
    <div class="col-lg-10"><textarea name="description" class="form-control" rows="5">{{ isset($category->description) ? $category->description:'' }}</textarea></div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Image</label>
    <div class="col-lg-5">
        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
            <div class="form-control" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                <span class="fileinput-filename"></span>
            </div>
            <span class="input-group-addon btn btn-default btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input onchange="showMyImage(this)" type="file" name="img"/>
            </span>
            <a onclick="removePreview()" href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label">Preview</label>
    <div class="col-sm-2">
        <?php
            if (isset($category->image)){
                $image_url = URL::to('public/admin/uploads/images/categories/'.$category->image);
            }else{
                $image_url = URL::to('public/admin/img/no-image.png');
            }
        ?>
        <img src="{{ $image_url }}" alt="Image" class="preview_image" id="img-preview">
    </div>
</div>

<div class="form-group"><label class="col-lg-2 control-label" for="status">Status</label>
    <div class="col-lg-10">
        <input {{ (isset($category->status) AND $category->status == 1) ? 'checked':'' }} name="status" value="1" type="checkbox" class="i-checks" id="status">
    </div>
</div>

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