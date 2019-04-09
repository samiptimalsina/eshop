@extends('frontend.layouts.master')

@section('content')
    <section id="cart_items">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        @include('partials.flash_messages.flashMessages')

        <div class="shopper-informations">
            <div class="col-sm-6 clearfix">
                <div class="bill-to">
                    <p>Shiping To</p>
                    <div class="form-one" style="width: 100%">

                        <?php
                            $shipping_info = Session::get('shipping_info');
                        ?>

                        <form action="{{ route('save-shipping-info') }}" method="post">
                            @csrf()
                            <input type="text" name="name" value="{{ isset($shipping_info)?$shipping_info[0]['name']:'' }}" placeholder="Name">
                            <input type="email" name="email" value="{{ isset($shipping_info)?$shipping_info[0]['email']:'' }}" placeholder="Email*" required>
                            <input type="text" name="phone" value="{{ isset($shipping_info)?$shipping_info[0]['phone']:'' }}" placeholder="phone*" required>
                            <input type="text" name="address" value="{{ isset($shipping_info)?$shipping_info[0]['address']:'' }}" placeholder="Address">
                            <input type="text" name="city" value="{{ isset($shipping_info)?$shipping_info[0]['city']:'' }}" placeholder="City">
                            <button type="submit" class="btn btn-block">Continue</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="order-message">
                    <p>Shipping Order</p>
                    <textarea name="notes" placeholder="Notes about your order, Special Notes for Delivery"
                              rows="16">{{ isset($shipping_info)?$shipping_info[0]['notes']:'' }}</textarea>
                </div>
            </div>
            </form>
        </div>
    </section> <!--/#cart_items-->
@endsection()