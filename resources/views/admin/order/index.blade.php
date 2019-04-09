@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Order</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/manage-order') }}">Orders</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        @include('partials.flash_messages.flashMessages')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Orders</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Order Total</th>
                                    <th>Payment Method</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php($i=1)
                                @foreach ($orders as $order)

                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ ucfirst($order->user->name) }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>{{ ucfirst($order->order_total) }}</td>
                                        <td>{{ ucfirst($order->payment->payment_method) }}</td>

                                        <td> {{ date("d-m-Y", strtotime($order->created_at)) }} </td>

                                        <td>
                                            <a href="{{ route('admin.orders.change-status', [$order->id, $order->status]) }}" title="Change status">
                                                @if($order->status)
                                                    <i class="fa fa-check-square-o"></i>
                                                @else
                                                    <i class="fa fa-clock-o"></i>
                                                @endif
                                            </a>
                                        </td>

                                        <td>
                                            <a title="View" href="{{ route('admin.orders.show', $order->id) }}" class="cus_mini_icon color-success"> <i class="fa fa-eye"></i></a>
                                            <a title="Delete" data-toggle="modal" data-target="#myModal{{$order->id}}" type="button" class="cus_mini_icon color-danger"><i class="fa fa-trash"></i></a>
                                        </td>

                                        <!-- The Modal -->
                                        <div class="modal fade in" id="myModal{{$order->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Delete order</h4>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                        <h3>You are going to delete Orders of  ' {{ ucfirst($order->user->name) }} ' ?</h3>

                                                        <a data-dismiss="modal" class="btn btn-sm btn-warning"><strong>No</strong></a>
                                                        <button class="btn btn-sm btn-primary" type="submit" onclick="event.preventDefault();
                                                                document.getElementById('order-delete-form{{ $order->id }}').submit();">
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

                                        <form id="order-delete-form{{ $order->id }}" method="POST" action="{{ route('admin.orders.destroy', $order->id) }}" style="display: none" >
                                            {{method_field('DELETE')}}
                                            @csrf()
                                        </form>

                                    </tr>

                                    @php($i++)
                                @endforeach

                                </tbody>
                            </table>
                            {{--{{ $all_order->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()