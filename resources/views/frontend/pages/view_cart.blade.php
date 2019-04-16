@extends('frontend.layouts.master')

@section('content')
    <div id="root">
        <section id="cart_items">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Cart</li>
                </ol>
            </div>

            @include('partials.flash_messages.flashMessages')

            @if( Count(Cart::instance('cart')->content()) > 0 )
                <div  v-if="carts.length > 0" >

                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="name">Name</td>
                                <td>Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td class="">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@foreach(Cart::instance('cart')->content() as $cart_product)--}}

                                <tr v-for='product in carts'>

                                    <td class="cart_product_img">
                                        <a href=""><img :src="'{{ URL::to('public/admin/uploads/images/products') }}/'+product.options.image" class="view_cart_image" alt="image"></a>
                                    </td>

                                    <td class="cart_name">
                                        <h4><a href="">@{{ product.name }}</a></h4>
                                    </td>

                                    <td class="cart_price">
                                        <p>@{{ product.price }} Tk</p>
                                    </td>

                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <form :action="'{{ route('cart.update', '') }}/'+product.rowId" method="post">
                                                @csrf()

                                                <input class="cart_quantity_input" type="number" name="qty" required :value="product.qty">
                                                <input type="submit" class="btn btn-default update" value="update">

                                            </form>
                                        </div>
                                    </td>

                                    <td class="cart_total">
                                        <p class="cart_total_price">@{{ product.subtotal }} Tk</p>
                                    </td>

                                    <td class="cart_delete" style="display: table-cell">
                                        <a href="#0" :row-id="product.rowId" @click="removeFromCart" title="Remove" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                    </td>

                                </tr>
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>

                    <section id="do_action">
                        <div class="row">
                            <div class="col-sm-8 col-lg-offset-2">
                                <div class="total_area">
                                    <ul>
                                        <li>Cart Sub Total  <span style="margin-left: 5px"> Tk </span> <span id="cart-sub-total">  </span> </li>
                                        <li>Eco Tax <span>{{ Cart::instance('cart')->tax() }}</span></li>
                                        <li>Shipping Cost <span>Free</span></li>
                                        <li>Total <span style="margin-left: 5px"> Tk </span>  <span id="cart-total"></span></li>
                                    </ul>
                                    <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
                                </div>
                            </div>
                            <div class="col-offset-2">

                            </div>
                        </div>
                    </section><!--/#do_action-->

                </div>

                <div v-else class="alert alert-warning alert-block">
                    <strong>Your cart is empty, You should go to <a href="{{url('/')}}"> shoping page </a></strong>
                </div>

            @else
                <div class="alert alert-warning alert-block">
                    <strong>Your cart is empty, You should go to <a href="{{url('/')}}"> shoping page </a></strong>
                </div>
            @endif

        </section>
    </div>

    <script>
        var WishCart = new Vue({
            el: "#root",
            data: {
                carts:[],
            },

            mounted() {
                this.getAllCartProduct();
                App.updateCartFinalCalculation();
            },

            methods:{
                getAllCartProduct(){
                    currentApp = this;
                    axios.get(home_url + '/carts/get/product')
                        .then(response => {
                            currentApp.carts = response.data;
                        })
                },

                removeFromCart(e){

                    currentApp = this
                    row_id = e.currentTarget.getAttribute('row-id');

                    //sweet alert
                    swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this item!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    }, function () {

                        axios.get(home_url + '/carts/remove/'+row_id)
                            .then(response => {

                                if (response){
                                    swal(response.data.title, response.data.message, response.data.type);
                                }

                                if (response.data.type == 'success'){
                                    currentApp.getAllCartProduct();
                                    App.updateCartCounter();
                                    App.updateCartFinalCalculation();
                                }
                            })
                    });
                },

            }
        })
    </script>
@endsection()
