
$(document).ready(function(){

    //zoom....
    $('.zoomple').zoomple({
        offset : {x:-150,y:-150},
        zoomWidth : 300,
        zoomHeight : 300,
        roundedCorners : true
    });

    $(function () {

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

    });

});

var App = new Vue({
    el: "#root",
    data: {
        wishlists:[],
        carts:[],
        product:{
            qty: 1,
        }
    },

    mounted(){
        this.getAllWishlistProduct();
        this.getAllCartProduct();
        this.updateWishlistCounter();
        this.updateCartCounter()
        this.updateCartFinalCalculation();
    },

    methods:{

        //Start Wishlist...............

        //Get all wishlist product
        getAllWishlistProduct(){
            currentApp = this;
            axios.get(home_url + '/wishlists/get/product')
                .then(response => {
                    currentApp.wishlists = response.data;
                })
        },

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

        //Product remove from wishlist
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
                            currentApp.updateWishlistCounter();
                        }
                    })
            });
        },

        //Product move to cart from wishlist
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
                        currentApp.updateWishlistCounter();
                        currentApp.updateCartCounter();
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

        //End Wishlist...............



        //Start Product...............

        //Get all cart product
        getAllCartProduct(){
            currentApp = this;
            axios.get(home_url + '/carts/get/product')
                .then(response => {
                    currentApp.carts = response.data;
                })
        },

        //Product add to cart
        addToCart(e) {

            currentApp = this;
            slug = e.currentTarget.getAttribute('slug');

            if (this.product.qty <= 0){
                swal('Warning', 'Quantity must be a valid number.', 'warning');
                return;
            }

            axios.post(home_url+'/carts/'+slug, this.product)
                .then(response => {

                    if (response) {

                        //sweet alert
                        swal(response.data.title, response.data.message, response.data.type);
                        currentApp.updateCartCounter();
                    }

                });
        },

        //Product remove from wishlist
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
                            currentApp.updateCartCounter();
                            currentApp.updateCartFinalCalculation();
                        }
                    })
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

                    //console.log(response.data.subTotal);

                    $('#cart-sub-total').html(response.data.subTotal)
                    $('#cart-total').html(response.data.total)
                });
        },

        //Start Product...............
    }
})
