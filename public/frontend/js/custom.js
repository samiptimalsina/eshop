
$(document).ready(function(){

    //zoom....
    $('.zoomple').zoomple({
        offset : {x:-150,y:-150},
        zoomWidth : 300,
        zoomHeight : 300,
        roundedCorners : true
    });

});
window.addEventListener('load', function (){
    initRateYo();
})

function initRateYo() {

    $(".rateYo").each(function () {
        var rating_score = $(this).attr('rating_score'),
            read_only = $(this).attr('read_only'),
            star_width = $(this).attr('star_width');

        $(this).rateYo({
            starWidth: star_width,
            halfStar: true,
            rating: rating_score,
            readOnly: read_only,

            onSet: function (rating, rateYoInstance) {
                $('#rating').val(rating);
            }
        });
    })
}

var App = new Vue({
    el: "",
    data: {},
    mounted(){},

    methods:{

        //Product add to wishlist
        addToWishlist(e) {
            slug = e.currentTarget.getAttribute('slug');
            currentApp = this

            axios.get(home_url + '/wishlists/'+slug)
                .then(response => {

                    if (response) {

                        //sweet alert
                        swal(response.data.title, response.data.message, response.data.type);
                    }

                    if (response.data.type == 'success'){
                        currentApp.updateWishlistCounter();
                    }
                });
        },

        //Instance update wishlist product counter
        updateWishlistCounter(){
            axios.get(home_url + '/wishlists/count/product')   //response = total count wishlist product
                .then(response => {

                    $('#wishlist-counter').addClass('counter');
                    $('#wishlist-counter').html(response.data);
                });
        },

        //Product add to cart
        addToCart(e, product) {
            currentApp = this;
            slug = e.currentTarget.getAttribute('slug');

            if (product.qty <= 0){
                swal('Warning', 'Quantity must be a valid number.', 'warning');
                return;
            }

            axios.post(home_url+'/carts/'+slug, product)
                .then(response => {

                    if (response) {

                        //sweet alert
                        swal(response.data.title, response.data.message, response.data.type);
                        currentApp.updateCartCounter();
                    }

                });
        },

        //Instance update cart product counter
        updateCartCounter(){
            axios.get(home_url + '/carts/count/product')   //response = total count cart product
                .then(response => {
                    $('#cart-counter').addClass('counter');
                    $('#cart-counter').html(response.data);
                });
        },

        //Instance update cart product total price calculation
        updateCartFinalCalculation(){
            axios.get(home_url + '/carts/final-calculate')
                .then(response => {
                    $('#cart-sub-total').html(response.data.subTotal)
                    $('#cart-total').html(response.data.total)
                });
        },
    }
})
