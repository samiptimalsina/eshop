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
                    <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
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

                        {{--Validation error--}}
                        <div v-if="validationErrors" class="form-group validation_msg_section">
                            <div class="alert alert-danger fade in">
                                <ul>
                                    <li v-for="(value, key, index) in validationErrors">@{{ value[0] }}</li>
                                </ul>
                            </div>
                        </div>


                        <p><b>Write Your Review</b></p>

                        @guest
                            <div class="review_login">
                                <p>Please log in to write review <a href="{{ route('login') }}" class="review_login_btn btn btn-default">Log in</a></p>
                            </div>
                        @else

                            <form class="review_form" id="review-form">

                                <textarea v-model="newReview.review" id="message" required="required" class="form-control" rows="8" placeholder="Your Review Here*"></textarea>
                                <input type="hidden" id="rating" value="">

                                <div star_width="24px" class="rateYo"></div>

                                <button @click="addReview" type="button" class="review_submit_btn btn btn-info pull-right" data-style="slide-down">Submit</button>
                            </form>
                        @endguest

                        <div class="review_section">

                            <div v-for="(review, index) in reviews" class="single_review">

                                <ul>
                                    <li><span> <i class="fa fa-user-circle-o" aria-hidden="true"></i> @{{ review.user.name }}</span></li>
                                    <li><span> <i class="fa fa-clock-o"></i> @{{ review.created_at | dateFormat('h:mm a') }} </span></li>
                                    <li><span> <i class="fa fa-calendar-o"></i> @{{ review.created_at | dateFormat('D MMMM YYYY')}}</span></li>
                                </ul>

                                <div class="user_rating_section">
                                    <i v-for="n in parseInt(review.rating)" class="ion-ios-star"></i>
                                </div>

                                <p id="review-text" class="review_text" style="max-height: 50px;">@{{ review.review }}</p>

                                <div v-if="review.review.length > 235" id="read-more-section" class="read_more_section">
                                    <div class="read-more-overlay--container">
                                        <div class="read-more-overlay"></div>
                                    </div>
                                </div>

                                <a v-if="review.review.length > 235" onclick="readMore(this)" type="button" class="cursor_pointer">Read more</a>

                                <div class="helpful-review">
                                    <p>
                                        <span v-if="review.review_votes_count > 0">
                                            <span class="posetive_negative_quantity">
                                                @{{ review.help_full_votes_count }} of @{{ review.review_votes_count }}
                                            </span>
                                            people found this review helpful.
                                        </span>
                                        Was this review helpful to you?
                                    </p>
                                </div>

                                <div class="review_action">
                                    <a @click="addVote" :review_id="review.id" vote_type="1" :review_index="index" type="button" class="btn btn-light">
                                        <img class="img-fluid" src="{{ URL::to('public/frontend/images/product-details/like.svg') }}">
                                    </a>
                                    <a @click="addVote" :review_id="review.id" vote_type="0" :review_index="index" type="button" class="btn btn-light">
                                        <img class="img-fluid" src="{{ URL::to('public/frontend/images/product-details/dislike.svg') }}">
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div v-if="reviews.length > 2" class="show_more_review_section">
                            <a @click="showMoreReview" type="button" class="cursor_pointer">Show more Review(s)</a>
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
                validationErrors: '',
            },

            mounted(){
                this.getAllReview();
                this.selectProductCategory();
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

                    axios.get(home_url + '/products/'+product_id+'/0/reviews')
                        .then(response => {
                            currentApp.reviews = response.data;
                        })
                },

                addReview (e) {

                    var loading_btn = $( '.review_submit_btn' ).ladda();
                    loading_btn.ladda( 'start' );

                    currentApp = this;

                    product_id = $('#product-id').attr('product-id');
                    currentApp.newReview.product_id = product_id;
                    currentApp.newReview.rating = $('#rating').val();

                    axios.post(home_url + '/products/' + product_id + '/0/reviews', currentApp.newReview)
                        .then(response => {
                            currentApp.reviews.unshift(response.data);
                            currentApp.validationErrors = '';

                            loading_btn.ladda('stop');
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 3000
                            };
                            toastr.success('Your review submit successfully.');

                            currentApp.newReview = {'review': ''};
                            $('#rating').val('');
                            $('#review-form').find('.jq-ry-rated-group').css('width', '0%');

                        },
                        errors => {
                            loading_btn.ladda('stop');
                            currentApp.validationErrors = errors.response.data.errors;
                        })

                },

                addVote(e){
                    currentApp = this;
                    var vote_type = e.currentTarget.getAttribute('vote_type'),
                        review_id = e.currentTarget.getAttribute('review_id'),
                        review_index = e.currentTarget.getAttribute('review_index');

                    axios.get(home_url + '/products/reviews/vote/'+vote_type+'/'+review_id)
                        .then(response => {
                            currentApp.reviews[review_index].review_votes_count = response.data.review_votes_count;
                            currentApp.reviews[review_index].help_full_votes_count = response.data.help_full_votes_count;

                        },errors => {
                            if(errors.response.data.message = "Unauthenticated"){
                                window.location.href = "{{ route('login') }}";
                            }
                        })
                },

                showMoreReview(){
                    product_id = $('#product-id').attr('product-id');
                    currentApp = this;
                    skip = currentApp.reviews.length; //skip review count

                    axios.get(home_url + '/products/'+product_id+'/'+skip+'/reviews')
                        .then(response => {

                            $.each(response.data, function(key, value) {
                                currentApp.reviews.push(value);
                            });
                        })
                },

                selectProductCategory(){
                    axios.get(home_url + '/products/'+'<?= Request::segment(2) ?>'+'/get-product-category-slug') // parameter = product slug
                        .then(response => {

                            $category_slug = response.data;

                            sideBar.expandParentCategory($category_slug);
                            $('#'+$category_slug+'-link').addClass('active');

                        });
                },
            },

            filters: {
                dateFormat: function (date, format) {
                    return moment(date).format(format);
                }
            }
        })

    </script>

@endsection()

