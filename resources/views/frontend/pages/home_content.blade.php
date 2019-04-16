@extends('frontend.layouts.master')

@section('content')

    <div id="root">

        @include('partials.flash_messages.flashMessages')

        @if(currentRoute() == '/')
            <div class="recommended_items">
                <h2 class="title text-center">Featured Products</h2>

                <div id="recommended-item-carousel" class="carousel slide" data-ride="{{ (count($featured_products) > 4)?'carousel':'' }}">
                    <div class="carousel-inner">
                        <div class="item active">

                            @php($i=0)
                            @foreach($featured_products as $product)

                            @if($i!=0 AND $i%4==0)
                        </div>
                        <div class="item">
                            @endif

                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <img src="{{ URL::to('public/admin/uploads/images/products/'.$product->image) }}" class="product_image" alt="" />
                                            </a>
                                            <h2>{{ $product->price }} Tk</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#0{{--{{ route('wishlist.store', $product->slug) }}--}}" slug="{{ $product->slug }}" @click="addToWishlist"><i class="fa fa-plus-square"></i>Wishlist</a></li>
                                            <li><a href="#0" class="trigger-quick-view" id="{{ $product->id }}"><i class="fa fa-eye"></i>Quick View</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            @php($i++)
                            @endforeach

                        </div>
                    </div>

                    @if(count($featured_products) > 4)
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    @endif

                </div>
            </div><!--/recommended_items-->
        @endif

        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">All Products</h2>

            {{--if search product--}}
            @if (currentRouteName() == 'products.search' AND count($products) == 0)
                <h3>Search for : “ {{ Request::get('search') }} ”</h3>
            @endif()

            @if(count($products) == 0)
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Warning!</strong> Product not found.
                </div>
            @endif()

            @foreach($products as $product)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{ route('products.show', $product->slug) }}">

                                    <?php
                                        if (isset($product->image)){
                                            $image_url = URL::to('public/admin/uploads/images/products/'.$product->image);
                                        }else{
                                            $image_url = URL::to('public/admin/img/no-image.png');
                                        }
                                    ?>

                                    <img src="{{ $image_url }}" class="product_image" alt="" />
                                </a>
                                <h2>{{ $product->price }} Tk</h2>
                                <p>{{ $product->name }}</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#0" slug="{{ $product->slug }}" @click="addToWishlist"><i class="fa fa-plus-square"></i>Wishlist</a></li>
                                <li><a href="#0" class="trigger-quick-view" id="{{ $product->id }}"><i class="fa fa-eye"></i>Quick View</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            @endforeach

            @if(count($products) > 0)
                @include('frontend.elements.quick_view')
            @endif

        </div><!--features_items-->

        {{ $products->Links() }}
    </div>

    <script>
        var HomeContent = new Vue({
            el: "#root",
            data: {
                product:{
                    qty: 1,
                },
            },

            mounted(){

            },

            methods:{

                addToWishlist(e){
                    App.addToWishlist(e);
                },

                addToCart(e){
                    App.addToCart(e, this.product);
                }
            }

        })
    </script>

@endsection()

