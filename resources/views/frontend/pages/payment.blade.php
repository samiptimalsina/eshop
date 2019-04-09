@extends('frontend.layouts.master')
@section('content')
    <section id="cart_items">
        <div class="container col-sm-12">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Payment method</li>
                </ol>
            </div>

            @include('partials.flash_messages.flashMessages')

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="name">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td class="">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Cart::instance('cart')->content() as $cart_product)
                        <tr>
                            <td class="cart_product_img">
                                <a href=""><img src="{{ URL::to('public/admin/uploads/images/products/'.$cart_product->options->image) }}"
                                                width="100px" height="100px" alt=""></a>
                            </td>
                            <td class="cart_name">
                                <h4><a href="">{{ $cart_product->name }}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ $cart_product->price }} Tk</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <form action="{{ route('cart.update', $cart_product->rowId) }}" >
                                        {{ csrf_field() }}
                                        <input class="cart_quantity_input" type="number" name="qty" required
                                               value="{{ $cart_product->qty }}" autocomplete="off" size="2">

                                        <input type="submit" class="btn btn-default update" value="update">
                                    </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ $cart_product->total }} Tk</p>
                            </td>
                            <td class="cart_delete" style="display: table-cell">
                                <a href="{{ route('cart.destroy', $cart_product->rowId) }}" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="paymentCont col-sm-8">
                <div class="headingWrap">
                    <h3 class="headingTop text-center">Select Your Payment Method</h3>
                </div>
                <div class="paymentWrap ">
                    <div class="btn-group paymentBtnGroup btn-group-justified" >
                        <form action="{{ route('order-place') }}" method="post">
                            {{ csrf_field() }}
                            <label class="btn paymentMethod ">
                                <div class="method visa"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQPXeJpOXSjCLzPp4MMgbPflXnrOstDVqFBw6eGMyWKIE0tl0"> </div>
                                <input type="radio"  name="payment_method_id" value="1">
                            </label>
                            <label class="btn paymentMethod">
                                <div class="method master-card"><img src="https://cdn.en.ntvbd.com/site/photo-1496731044"> </div>
                                <input type="radio"   name="payment_method_id" value="2">
                            </label>
                            <label class="btn paymentMethod">
                                <div class="method amex"><img src="https://themerkle.com/wp-content/uploads/Payza.png"> </div>
                                <input type="radio"   name="payment_method_id" value="3">
                            </label>
                            <div class="footerNavWrap clearfix">
                                <input type="submit" class="btn btn-default update" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection