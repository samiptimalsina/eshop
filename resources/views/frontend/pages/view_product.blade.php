@extends('frontend.layouts.master')

@section('content')

    <div id="root">

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Products</li>
                <li class="active">{{ $product->name }}</li>
            </ol>
        </div>

        <div class="product-details"><!--product-details-->

            @include('partials.flash_messages.flashMessages')

            <div class="col-sm-5">
                <div class="view-product">
                    <a href="{{ URL::to('public/admin/uploads/images/products/'.$product->image) }}" class="zoomple">
                        <img src="{{ URL::to('public/admin/uploads/images/products/'.$product->image) }}" alt=""/>
                    </a>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="product-information">
                    <img src="{{ URL::to('public/frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                    <h2>{{ $product->name }}</h2>

                    @if ($product->reviews->count() > 0)
                        <div read_only=true rating_score="{{ round($product->reviews->sum('rating')/$product->reviews->count(),2) }}" star_width="18px" class="rateYo"></div>

                        <div>
                            {{ round($product->reviews->sum('rating')/$product->reviews->count(),2) }} Ratings
                        </div>
                    @else
                        <p>No rating yet</p>
                    @endif

                    <div class="row">

                        <form class="add_to_cart_form">

                            <span class="price">{{ $product->price }} Tk.</span>
                            <label>Quantity:</label>
                            <input v-model="product.qty" name="qty" type="number" class="custom_number_input"/>
                            <a href="#0" id="product-id" product-id="{{ $product->id }}" slug="{{ $product->slug }}" @click="addToCart" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            <a href="#0" slug="{{ $product->slug }}" @click="addToWishlist" class="btn btn-default cart"><i class="fa fa-plus"></i> Wishlist</a>

                        </form>

                    </div>

                    <p><b>Brand:</b> {{ $product->brand->name }}</p>
                    <p><b>Category:</b> {{ $product->category->name }}</p>
                    <p><b>Descriptions:</b> {{ $product->description }} </p>
                </div>
            </div>
        </div>


        {{--Review--}}
        <div class="category-tab shop-details-tab">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews ( {{ count($product->reviews) }} )</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                    <div class="col-sm-12">
                        .............
                    </div>
                </div>

                <div class="tab-pane fade active in" id="reviews" >
                    <div class="col-sm-12">

                        <p><b>Write Your Review</b></p>

                        @guest
                            <div class="review_login">
                                <p>Please log in to write review <a href="{{ route('login') }}" class="review_login_btn btn btn-default">Log in</a></p>
                            </div>
                        @else

                            <form class="review_form" id="review-form">
                                @csrf()

                                <textarea v-model="newReview.review" id="message" required="required" class="form-control" rows="8" placeholder="Your Review Here*"></textarea>
                                <input type="hidden" id="rating" value="">

                                <div star_width="24px" class="rateYo"></div>

                                <button @click="addReview" type="button" class="ladda-button btn btn-info pull-right" data-style="slide-down">Submit</button>
                                <button type="button" class="ladda-button btn btn-info" data-style="slide-down">Submit</button>
                            </form>
                        @endguest

                        <div class="review_section">

                            <div v-for="review in reviews" class="single_review">

                                <ul>
                                    <li><span> <i class="fa fa-user-circle-o" aria-hidden="true"></i> @{{ review.user.name }}</span></li>
                                    <li><span> <i class="fa fa-clock-o"></i> @{{ review.created_at | moment('h:mm a') }} </span></li>
                                    <li><span> <i class="fa fa-calendar-o"></i> @{{ review.created_at | moment('D MMMM YYYY')}}</span></li>
                                </ul>

                                <div class="user_rating_section">
                                    <div read_only=true :rating_score="review.rating" star_width="16px" class="rateYo"></div>
                                </div>

                                <p>@{{ review.review }}</p>

                                {{--<div class="helpful-review">
                                    <p>
                                        @if($review->help_full OR $review->not_help_full)
                                            <span class="posetive_negative_quantity">
                                                {{ $review->help_full }} of {{ $review->help_full+$review->not_help_full }}
                                            </span>
                                            people found this review helpful.
                                        @endif
                                            Was this review helpful to you?
                                    </p>
                                </div>--}}

                                <div class="review_action">
                                    <a href="#" class="btn btn-light">
                                        <img class="img-fluid" src="{{ URL::to('public/frontend/images/product-details/like.svg') }}">
                                    </a>
                                    <a href="#" class="btn btn-light">
                                        <img class="img-fluid" src="{{ URL::to('public/frontend/images/product-details/dislike.svg') }}">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div><!--/category-tab-->

        {{--Related Products--}}
        @if(count($related_products) > 0)

            <div class="recommended_items">
            <h2 class="title text-center">Related Products</h2>
            <div id="recommended-item-carousel" class="carousel slide" data-ride="{{ (count($related_products) > 4)?'carousel':'' }}">
                <div class="carousel-inner">
                    <div class="item active">
                        @php($i=0)
                        @foreach($related_products as $product)

                            @if($i!=0 AND $i%4===0)
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

                @if(count($related_products) > 4)
                    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                @endif

            </div>
        </div>

        @include('frontend.elements.quick_view')
    @endif

    </div>

    <script>

        var ViewProduct = new Vue({
            el: "#root",
            data: {
                product:{
                    qty: 1,
                },
                newReview:{
                    review: '',
                    rating: '',
                },
                reviews:[],
            },

            mounted(){
                this.getAllReview();
            },

            methods:{

                addToWishlist(e){
                    App.addToWishlist(e);
                },

                addToCart(e){
                    App.addToCart(e, this.product);
                },

                getAllReview() {
                    product_id = $('#product-id').attr('product-id');
                    currentApp = this;

                    axios.get(home_url + '/products/'+product_id+'/reviews/')
                        .then(response => {
                            currentApp.reviews = response.data;
                        })
                },

                addReview(e){

                    var loading_btn = $( '.ladda-button' ).ladda();

                    // Start loading
                    loading_btn.ladda( 'start' );

                    currentApp = this;

                    product_id = $('#product-id').attr('product-id');
                    currentApp.newReview.product_id = product_id;
                    currentApp.newReview.rating = $('#rating').val();

                    axios.post(home_url + '/products/'+product_id+'/reviews', currentApp.newReview)
                        .then(response => {
                            currentApp.reviews.push(response.data);

                            setTimeout(function () {
                                initRateYo(); //define in custom.js
                                loading_btn.ladda('stop');
                            });

                            currentApp.newReview = {'review' : ''};
                            $('#rating').val('');
                            $('#review-form').find('.jq-ry-rated-group').css('width', '0%');
                        })
                },

                /*getProductReview(){
                    axios.get(home_url + '/products/'+product_id+'/get-rating')
                        .then(response => {
                                console.log(response.data);
                            }
                        )
                }*/
            },

            filters: {
                moment: function (date, format) {
                    return moment(date).format(format);
                }
            }
        })

    </script>

@endsection()

