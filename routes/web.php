<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*Test cron job*/
Route::get('cron', function (){
    info('Cron job work properly');
})->name('cron');

Route::get('/es-clear', function () {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');

    return 'true';
});

//Frontend..............................
Route::get('/', 'HomeController@index')->name('frontend.index');
Route::get('products/category/{category}', 'HomeController@productByCategory')->name('products.byCategory');
Route::get('products/brand/{brand}', 'HomeController@productByBrand')->name('products.byBrand');
Route::get('products', 'HomeController@search')->name('products.search');

//Product......................
Route::get('products/{product}', 'ProductsController@show')->name('products.show');
Route::get('products/get-info/{product}', 'ProductsController@getProductInfo')->name('products.getInfo');
/*Route::get('products/get-reviews/{product}', 'ProductsController@getProductReview')->name('products.getReview');*/
Route::get('products/category/{category}/get-parent-category', 'ProductsController@getParentCategory');
Route::get('products/{product}/get-product-category-slug', 'ProductsController@getProductCategorySlug');

//Cart.........................................................
Route::get('carts', 'CartsController@index')->name('cart.index');
Route::post('carts/{product}', 'CartsController@store')->name('cart.store');
Route::get('carts/remove/{rowId}', 'CartsController@destroy')->name('cart.destroy');
Route::post('carts/update/{rowId}', 'CartsController@update')->name('cart.update');
Route::get('carts/count/product', 'CartsController@count')->name('cart.count');
Route::get('carts/get/product', 'CartsController@getCartProduct')->name('cart.get-product');
Route::get('carts/final-calculate', 'CartsController@finalCalculate')->name('cart.final-calculate');

//Wishlist................................
Route::get('wishlists', 'WishListsController@index')->name('wishlist.index');
Route::get('wishlists/{product}', 'WishListsController@store')->name('wishlist.store');
Route::get('wishlists/remove/{rowId}', 'WishListsController@destroy')->name('wishlist.destroy');
Route::get('wishlists/move-cart/{rowId}', 'WishListsController@moveToCart')->name('wishlist.move-cart');
Route::get('wishlists/count/product', 'WishListsController@count')->name('wishlist.count');
Route::get('wishlists/get/product', 'WishListsController@getWishlistProduct')->name('wishlist.get-product');

//Review................................
Route::group(['prefix' => 'products'], function (){
    Route::resource('{products}/{skip}/reviews', 'ReviewsController');
});

Route::group(['middleware' => 'auth', 'prefix' => 'products'], function (){
    Route::get('reviews/vote/{vote}/{reviews}', 'ReviewsController@addVote')->name('reviews.vote.store');
});

Route::group(['middleware' => 'auth'], function (){

    //Checkout..............................
    Route::get('checkout', 'CheckoutsController@index')->name('checkout');
    Route::post('save-shipping-info', 'CheckoutsController@saveShippingInfo')->name('save-shipping-info');
    Route::get('payment', 'CheckoutsController@payment')->name('payment');
    Route::post('order-place', 'CheckoutsController@orderPlace')->name('order-place');

    //User profile.........................
    Route::group(['prefix' => 'my-profile'], function (){
        Route::get('/', 'UsersController@showProfile')->name('user.myProfile');
        Route::get('get-info', 'UsersController@getProfileInfo')->name('user.getProfileInfo');
        Route::post('/', 'UsersController@updateProfile')->name('user.myProfile');
        Route::post('image/upload', 'UsersController@imageUpload')->name('user.imageUpload');
        Route::post('change-password', 'UsersController@updatePassword')->name('user.updatePassword');
    });

});

//Contact................
Route::get('contact', 'ContactsController@index')->name('contact');
Route::post('contact', 'ContactsController@submitContact')->name('contact');

//Users Auth.....................................
Auth::routes();











//Admin......................................
Route::group(['middleware' => ['auth:admin', 'preventBackHistory'], 'prefix' => 'admin'], function (){

    Route::name('admin.')->group(function () {

        //Brand..........................................
        Route::get('brands/{brand}/{old}/change-status', 'Admin\BrandsController@changeStatus')->name('brands.change-status');
        Route::resource('brands', 'Admin\BrandsController');

        //Category.......................................
        Route::get('categories/{category}/{old}/change-status', 'Admin\CategoriesController@changeStatus')->name('categories.change-status');
        Route::resource('categories', 'Admin\CategoriesController');

        //Sliders........................................
        Route::get('sliders/{slider}/{old}/change-status', 'Admin\SlidersController@changeStatus')->name('sliders.change-status');
        Route::resource('sliders', 'Admin\SlidersController');

        //Products.............................................
        Route::get('products/{product}/{old}/change-featured', 'Admin\ProductsController@changeFeatured')->name('products.change-featured');
        Route::get('products/{product}/{old}/change-status', 'Admin\ProductsController@changeStatus')->name('products.change-status');
        Route::resource('products', 'Admin\ProductsController');

        //Orders..............................................
        Route::get('orders/unseen', 'Admin\OrdersController@getUnseenOrder')->name('orders.unseen');
        Route::get('orders/{order}/{old}/change-status', 'Admin\OrdersController@changeStatus')->name('orders.change-status');
        Route::resource('orders', 'Admin\OrdersController');

    });

});



//Admin Authentication
Route::group(['middleware' => 'preventBackHistory'], function (){

    //Admin Authentication Route..........................
    Route::get('admin/dashboard', 'Admin\DashboardsController@index');

    //Admin Login Routes..................................
    Route::get('admin', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin', 'Admin\Auth\LoginController@login');
    Route::post('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes.....................................................
    Route::get('admin/register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('admin/register', 'Admin\Auth\RegisterController@register');

    // Password Reset Routes.....................................................
    Route::get('admin/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.reset');

    //Admin profile Routes.....................................
    Route::get('admin/profile', 'Admin\AdminsController@showProfile')->name('admin.profile');
    Route::post('admin/profile', 'Admin\AdminsController@updateProfile')->name('admin.profile');

    //Admin Password Change.......................................
    Route::get('admin/change-password', 'Admin\AdminsController@changePassword')->name('admin.changePassword');
    Route::post('admin/change-password', 'Admin\AdminsController@updatePassword')->name('admin.changePassword');

    //Admin Profile Picture Change.......................................
    Route::get('admin/change-profile-picture', 'Admin\AdminsController@changeProfilePicture')->name('admin.changeProfilePicture');
    Route::post('admin/change-profile-picture', 'Admin\AdminsController@updateProfilePicture')->name('admin.changeProfilePicture');
});

Route::get('curl', function (){
    return ['status' => 'success', 'message' => 'Curl work properly.'];
})->name('curl-response');

Route::get('test-curl', function (){

    $curl = curl_init();

    $postUrl = route('curl-response');

    curl_setopt_array($curl, array(
        CURLOPT_URL => $postUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);

    print_r($response);

    $err = curl_error($curl);

    if ($err) dd($err);

    curl_close($curl);
});