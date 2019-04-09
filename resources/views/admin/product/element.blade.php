
@include('partials.flash_messages.flashMessages')

<div class="col-sm-6">
    <div class="form-group">
        <label>Name<span class="required-star"> *</span></label>
        <input value="{{ isset($product->name) ? $product->name:'' }}" required="required" id="slug-source"  name="name" type="text" class="form-control">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Size</label>
        <input value="{{ isset($product->size) ? $product->size:'' }}" name="size" type="text" class="form-control">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Slug<span class="required-star"> *</span></label>
        <input value="{{ isset($product->slug) ? $product->slug:'' }}" id="slug" readonly="readonly" style="cursor: not-allowed" required="required" name="slug" type="text" class="form-control">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Color</label>
        <input value="{{ isset($product->color) ? $product->color:'' }}" name="color" type="text" class="form-control">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Category<span class="required-star"> *</span></label>
        <select class="form-control" name="category_id" required="required">
            <option value="">select</option>
            @foreach($categories as $category)
                <option {{ isset($product->id)?(($product->category->id == $category->id)?'selected':''):'' }} value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Brand<span class="required-star"> *</span></label>
        <select class="form-control" name="brand_id" required="required">
            <option value="">select</option>
            @foreach($brands as $brand)
                <option {{ isset($product->id)?(($product->brand->id == $brand->id)?'selected':''):'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Price<span class="required-star"> *</span></label>
        <input value="{{ isset($product->price) ? $product->price:'' }}" required="required" name="price"  type="number" class="form-control">
    </div>
</div>

<div class="col-sm-6">
    <div class="form-group">
        <label>Image</label>
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

<div class="col-sm-6">
    <div class="form-group">
        <label >Description</label>
        <textarea name="description" maxlength="191" class="form-control" rows="5">{{ isset($product->description) ? $product->description:'' }}</textarea>
    </div>
</div>

<div class="col-sm-2">
    <div class="form-group">

        <?php
            if (isset($product->image)){
                $image_url = URL::to('public/admin/uploads/images/products/'.$product->image);
            }else{
                $image_url = URL::to('public/admin/img/no-image.png');
            }
        ?>

        <label >Preview</label>
        <div class="">
            <img src="{{ $image_url }}" alt="Image" class="preview_image" id="img-preview">
        </div>

    </div>
</div>

<div class="col-sm-6">&nbsp;</div>

<div class="form-group">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-3">
                <input {{ (isset($product->status) AND $product->status == 1) ? 'checked':'' }} name="status" value="1"
                       type="checkbox" class="i-checks" id="status">
                <label for="status"> Status</label>
            </div>

            <div class="col-sm-3">
                <input {{ (isset($product->featured) AND $product->featured == 1) ? 'checked':'' }} name="featured"
                       value="1" type="checkbox" class="i-checks" id="featured">
                <label for="featured"> Featured</label>
            </div>
        </div>
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