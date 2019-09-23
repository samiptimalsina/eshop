@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Trash Product</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.products.index') }}">Products</a>
                </li>
                <li class="active">
                    <strong>Trash</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        @include('partials.flash_messages.flashMessages')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Products</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">

                            <form id="bulk-delete" action="{{ route('admin.products.bulk-action') }}" method="POST">
                                @csrf

                                <div class="row form-inline">
                                    <div class="col-sm-6">
                                        <label>
                                            <select name="bulk_action" class="form-control input-sm">
                                                <option value="">Bulk Actions</option>
                                                <option value="restore">Restore</option>
                                                <option value="delete">Delete</option>
                                            </select>
                                        </label>
                                        <button type="button" class="btn btn-sm" onclick="document.getElementById('bulk-delete').submit()">submit</button>
                                    </div>
                                </div>

                                <table class="table table-striped table-bordered table-hover trash-dataTable" >
                                    <thead>
                                    <tr>
                                        <th class="trash-table no-padding">
                                            <label class="customcheck">
                                                <input id="checkAll" type="checkbox"><span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Image</th>
                                        <th>Category Name</th>
                                        <th>Brand Name</th>
                                        <th>Price</th>
                                        <th>Featured</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($products as $product)

                                        <tr>
                                            <td>
                                                <label class="customcheck">
                                                    <input name="product_id[]" value="{{ $product->id }}" type="checkbox"><span class="checkmark"></span>
                                                    </form> {{--End of bulk action form--}}
                                                </label>
                                            </td>
                                            <td>{{ ucfirst($product->name) }}</td>
                                            <td>{{ $product->slug }}</td>

                                            <?php
                                            if (isset($product->image)){
                                                $image_url = URL::to('public/admin/uploads/images/products/'.$product->image);
                                            }else{
                                                $image_url = URL::to('public/admin/img/no-image.png');
                                            }
                                            ?>

                                            <td><img src="{{ $image_url }}" class="cus_thumbnail"></td>

                                            <td> {{ ucfirst($product->category->name) }}</td>
                                            <td> {{ ucfirst($product->brand->name) }}</td>
                                            <td> {{ $product->price }} Tk</td>

                                            <td>
                                                <a href="{{ route('admin.products.change-featured', [$product->id, $product->featured]) }}" title="Change featured">
                                                    @if($product->featured)
                                                        <i class="fa fa-check-square-o"></i>
                                                    @else
                                                        <i class="fa fa-times"></i>
                                                    @endif
                                                </a>
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.products.change-status', [$product->id, $product->status]) }}" title="Change publication status">
                                                    @if($product->status)
                                                        <i class="fa fa-check-square-o"></i>
                                                    @else
                                                        <i class="fa fa-times"></i>
                                                    @endif
                                                </a>
                                            </td>

                                            <td> {{ date("d-m-Y", strtotime($product->created_at)) }}</td>

                                            <td>
                                                <a title="Restore" href="{{ route('admin.products.restore', $product->id) }}" class="cus_mini_icon color-success"> <i class="fa fa-refresh"></i></a>
                                                <a title="Trash" data-toggle="modal" data-target="#myModal{{$product->id}}" type="button" class="cus_mini_icon color-danger"><i class="fa fa-recycle"></i></a>
                                            </td>

                                            <!-- The Modal -->
                                            <div class="modal fade in" id="myModal{{$product->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Delete product</h4>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <h3>You are going to trash ' {{ $product->name }} ' ?</h3>

                                                            <a data-dismiss="modal" class="btn btn-sm btn-warning"><strong>No</strong></a>
                                                            <button class="btn btn-sm btn-primary" type="submit" onclick="event.preventDefault();
                                                                    document.getElementById('product-delete-form{{ $product->id }}').submit();">
                                                                <strong>Yes</strong>
                                                            </button>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <form id="product-delete-form{{ $product->id }}" method="POST" action="{{ route('admin.products.trash', $product->id) }}" style="display: none" >
                                                @csrf()
                                            </form>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

    </script>

@endsection()

@section('custom-js')

    <script type="text/javascript">

        $('.trash-dataTable').DataTable({

            columnDefs: [ {
                'targets': 0, /* column index */
                'orderable': false, /* true or false */
                'icon': false
            }]

        });
    </script>

@endsection