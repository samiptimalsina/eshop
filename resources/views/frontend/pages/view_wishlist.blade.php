@extends('frontend.layouts.master')

@section('content')
    <div id="root">
        <section id="cart_items">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Wishlist</li>
                </ol>
            </div>

            @include('partials.flash_messages.flashMessages')

            @if( Count(Cart::instance('wishlist')->content()) > 0 )
                <div v-if="wishlists.length > 0" class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Image</td>
                            <td class="name">Name</td>
                            <td>Price</td>
                            <td class="total">Action</td>
                            <td class=""></td>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach(Cart::instance('wishlist')->content() as $wishlist_product)--}}
                            <tr v-for='product in wishlists'>

                                <td class="cart_product_img">
                                    <a href=""><img :src="'{{ URL::to('public/admin/uploads/images/products/') }}/'+product.options.image" alt="image" class="view_cart_image"></a>
                                </td>
                                <td class="cart_name">
                                    <h4><a href="">@{{ product.name }}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>@{{ product.price }} Tk</p>
                                </td>
                                <td class="cart_delete" style="display: table-cell">
                                    <a href="#0" :row-id="product.rowId" @click="removeFromWishlist" title="Remove" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                </td>
                                <td>
                                    <a :row-id="product.rowId" @click="moveToCart" class="btn btn-default update add_to_cart">Move to cart</a>
                                </td>

                            </tr>
                        {{--@endforeach--}}
                        </tbody>
                    </table>
                </div>

                <div v-else class="alert alert-warning alert-block">
                    <strong>Your wishlist is empty, You should go to <a href="{{url('/')}}"> shoping page </a></strong>
                </div>

            @else
                <div class="alert alert-warning alert-block">
                    <strong>Your wishlist is empty, You should go to <a href="{{url('/')}}"> shoping page </a></strong>
                </div>
            @endif
        </section> <!--/#cart_items-->
    </div>


    <script>
        var Wishlist = new Vue({
            el: "#root",
            data: {
                wishlists:[]
            },

            mounted(){
              this.getAllWishlistProduct();
            },

            methods:{

                getAllWishlistProduct(){
                    currentApp = this;
                    axios.get(home_url + '/wishlists/get/product')
                        .then(response => {
                            currentApp.wishlists = response.data;
                        })
                },

                removeFromWishlist(e){

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

                        axios.get(home_url + '/wishlists/remove/'+row_id)
                            .then(response => {

                                if (response){
                                    swal(response.data.title, response.data.message, response.data.type);
                                }

                                if (response.data.type == 'success'){
                                    currentApp.getAllWishlistProduct();
                                    App.updateWishlistCounter();
                                }
                            })
                    });
                },

                moveToCart(e){

                    row_id = e.currentTarget.getAttribute('row-id')
                    axios.get(home_url + '/wishlists/move-cart/'+row_id)   //response = total count wishlist product
                        .then(response => {

                            if (response) {

                                //sweet alert
                                swal(response.data.title, response.data.message, response.data.type);
                            }

                            if (response.data.type == 'success'){
                                currentApp.getAllWishlistProduct();
                                App.updateWishlistCounter();
                                App.updateCartCounter();
                            }

                        });

                },
            }

        })
    </script>

@endsection()