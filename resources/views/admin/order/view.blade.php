@extends('admin.layouts.master')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>View Order</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/manage-order') }}">Orders</a>
                </li>
                <li class="active">
                    <strong>View</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Customer Details</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Shipping Details</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Notes</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>{{ ucfirst($order->shipping->name) }}</td>
                                <td class="center">{{ $order->shipping->email }}</td>
                                <td class="center">{{ $order->shipping->phone }} </td>
                                <td class="center">{{ ucfirst($order->shipping->address) }}</td>
                                <td class="center">{{ ucfirst($order->shipping->city) }}</td>
                                <td class="center">{{ ucfirst($order->shipping->notes) }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Order Details</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $i=0; ?>
                            @foreach($order->orderDetails as $item)
                                <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td class="center">{{ ucfirst($item->product->name) }}</td>
                                    <td class="center"><img src="{{ URL::to('public/admin/uploads/images/products/'.$item->product->image) }}" class="cus_thumbnail"></td>
                                    <td class="center">{{ $item->product->price }} Tk</td>
                                    <td class="center">{{ $item->product_qty }}</td>
                                    <td class="center">{{ $item->product->price*$item->product_qty }} Tk</td>
                                    <?php
                                    $sub_total[] = $item->product->price*$item->product_qty;
                                    ?>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="total pull-right">
                            <span><b>Total:</b> {{ $order->order_total }} Tk</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection()