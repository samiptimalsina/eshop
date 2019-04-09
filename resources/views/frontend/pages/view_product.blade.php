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
                    <p>{{ $product->reviews->count() > 0 ? round($product->reviews->sum('rating')/$product->reviews->count(),2)
                        : 'No rating yet' }}
                    </p>
                    <div class="row">

                        <form class="add_to_cart_form">

                            <span class="price">{{ $product->price }} Tk.</span>
                            <label>Quantity:</label>
                            <input v-model="product.qty" name="qty" type="number" class="custom_number_input"/>
                            <a href="#0" slug="{{ $product->slug }}" @click="addToCart" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>
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
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade active in" id="reviews" >
                    <div class="col-sm-12">

                        @foreach($product->reviews as $review)

                            <div class="review_section">

                                <ul>
                                    <li><a href="#0"><i class="fa fa-user"></i>{{ ucfirst($review->user->name) }}</a></li>
                                    <li><a href="#0"><i class="fa fa-clock-o"></i>{{ $review->created_at->format('h:i A') }}</a></li>
                                    <li><a href="#0"><i class="fa fa-calendar-o"></i>{{ $review->created_at->format('d F Y') }}</a></li>
                                </ul>

                                <div class="user_rating_section">
                                    @for ($i = 1; $i <= $review->rating ; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </div>

                                <p>{{ ucfirst($review->review) }}</p>

                            </div>

                        @endforeach

                        <p><b>Write Your Review</b></p>

                        <form action="{{ route('reviews.store') }}" method="post">
                            @csrf()

                            <textarea name="review" ></textarea>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="rating" id="rating" value="">

                            <label>Rating : </label>
                            <div id="rateBox"></div>

                            <button type="submit" class="btn btn-default pull-right">Submit</button>
                        </form>
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
@endsection()


