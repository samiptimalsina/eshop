@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Slider</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.sliders.index') }}">Sliders</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <div class="ibox-tools">
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><i class="fa fa-plus"></i> <strong>Create</strong></a>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        @include('partials.flash_messages.flashMessages')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sliders</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php($i=1)
                                @foreach ($sliders as $slider)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ ucfirst($slider->name) }}</td>

                                        <?php
                                            if (isset($slider->image)){
                                                $image_url = URL::to('admin/uploads/images/sliders/'.$slider->image);
                                            }else{
                                                $image_url = URL::to('admin/img/no-image.png');
                                            }
                                        ?>

                                        <td><img src="{{ $image_url }}" class="cus_thumbnail"></td>
                                        <td>{{ ucfirst($slider->description) }}</td>

                                        <td>
                                            <a href="{{ route('admin.sliders.change-status', [$slider->id, $slider->status]) }}" title="Change publication status">
                                                @if($slider->status)
                                                    <i class="fa fa-check-square-o"></i>
                                                @else
                                                    <i class="fa fa-times"></i>
                                                @endif
                                            </a>
                                        </td>

                                        <td> {{ date("d-m-Y", strtotime($slider->created_at)) }}</td>

                                        <td>
                                            <a title="Edit" href="{{ route('admin.sliders.edit', $slider->id) }}" class="cus_mini_icon color-success"> <i class="fa fa-pencil-square-o"></i></a>
                                            <a title="Delete" data-toggle="modal" data-target="#myModal{{$slider->id}}" type="button" class="cus_mini_icon color-danger"><i class="fa fa-trash"></i></a>
                                        </td>

                                        <!-- The Modal -->
                                        <div class="modal fade in" id="myModal{{$slider->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Delete slider</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        <h3>You are going to delete ' {{ $slider->name }} ' ?</h3>

                                                        <a data-dismiss="modal" class="btn btn-sm btn-warning"><strong>No</strong></a>
                                                        <button class="btn btn-sm btn-primary" type="submit" onclick="event.preventDefault();
                                                                document.getElementById('slider-delete-form{{ $slider->id }}').submit();">
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

                                        <form id="slider-delete-form{{ $slider->id }}" method="POST" action="{{ route('admin.sliders.destroy', $slider->id) }}" style="display: none" >
                                            {{method_field('DELETE')}}
                                            @csrf()
                                        </form>

                                    </tr>
                                    @php($i++)
                                @endforeach

                                </tbody>
                            </table>
                            {{--{{ $sliders->links() }}--}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
