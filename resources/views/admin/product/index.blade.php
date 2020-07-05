@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Product</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/all-product') }}">Products</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
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
                        <a href="{{ route('admin.products.trash.index') }}" class="badge badge-danger pull-right">View Trash ({{ $trash_products_qty }})</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl No</th>
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

                                @php($i=1)
                                @foreach ($products as $product)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ ucfirst($product->name) }}</td>
                                        <td>{{ $product->slug }}</td>

                                        <?php
                                            if (isset($product->image)){
                                                $image_url = URL::to('admin/uploads/images/products/'.$product->image);
                                            }else{
                                                $image_url = URL::to('admin/img/no-image.png');
                                            }
                                        ?>

                                        <td><img src="{{ $image_url }}" class="cus_thumbnail"></td>

                                        <td> {{ ucfirst($product->category->name) }}</td>
                                        <td> {{ ucfirst($product->brand->name) }}</td>
                                        <td> {{ $product->price }} Tk</td>

                                        <td>
                                            <a href="{{ route('admin.products.change-featured', [$product->id, $product->featured]) }}" title="Change featured">
                                                @if($product->featured)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Disable</span>
                                                @endif
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.products.change-status', [$product->id, $product->status]) }}" title="Change publication status">
                                                @if($product->status)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Active</span>
                                                @endif
                                            </a>
                                        </td>

                                        <td> {{ date("d-m-Y", strtotime($product->created_at)) }}</td>

                                        <td>
                                            <a title="Edit" href="{{ route('admin.products.edit', $product->id) }}" class="cus_mini_icon color-success"> <i class="fa fa-pencil-square-o"></i></a>
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
                                    @php($i++)
                                @endforeach

                                </tbody>
                            </table>
                            {{--{{ $products->links() }}--}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
