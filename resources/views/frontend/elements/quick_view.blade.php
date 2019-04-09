
{{--quick view--}}
    <div class="cd-quick-view">
        <div class="cd-slider-wrapper">
            <ul class="cd-slider">
                <li class="selected"><img src="" id="selected-image" alt="Image"></li>
            </ul>

        {{--<ul class="cd-slider-navigation">
            <li><a class="cd-next" href="#0">Prev</a></li>
            <li><a class="cd-prev" href="#0">Next</a></li>
        </ul>--}} <!-- cd-slider-navigation -->

        </div> <!-- cd-slider-wrapper -->

        <div class="cd-item-info">
            <h2 id="product-title"></h2>

            <p><b>Price :</b> <span id="product-price"></span> Tk </p>
            <p><b>Brand :</b> <span id="product-brand"></span> </p>
            <p><b>Category :</b> <span id="product-category"></span> </p>
            <p id="product-description"></p>

            {{--<form id="cart-form" method="POST" action="{{ route('cart.store', $product->slug) }}" class="add_to_cart_form">--}}
            <form class="add_to_cart_form">

                <label>Quantity:</label>
                <input v-model="product.qty" name="qty" type="number" class="custom_number_input"/>
                <a id="cart-url" href="#0" slug="" @click="addToCart" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                <a id="wishlist-url" href="#0" slug="" @click="addToWishlist" class="btn btn-default cart"><i class="fa fa-plus"></i> Add to wishlist</a>

            </form>

        </div> <!-- cd-item-info -->
        <a href="#0" class="cd-close">Close</a>
    </div> <!-- cd-quickView -->
