<?php
/**
 * Created by PhpStorm.
 * User: Abdullah
 * Date: 11/05/2018
 * Time: 7:46 PM
 */

use App\Brand;
use App\Category;
use App\Order;
use App\product;
use App\Slider;


/**
 * Current controller name
 * @return string
 */
function currentController(){
    return class_basename(Route::current()->controller);
}

/**
 * Current route
 * @return string
 */
function currentRoute(){
    return Route::current()->uri();
}

/**
 * Current route name
 * @return string|null
 */
function currentRouteName(){
   return Route::currentRouteName();
}

/**
 * Count product for frontend
 * @param $whiceId
 * @param $id
 * @return int
 */
function countProduct($whiceId, $id){
    $products = product::with('brand', 'category')
        ->where(['status' => 1, $whiceId => $id])
        ->get();
    return $products->count();
}

/**
 * Get all published slider for fronted
 * @return mixed
 */
function sliders(){
    $sliders = Slider::orderBy('id', 'desc')->where('status', true)->get();
    return $sliders;
}

/**
 * Get all published category for frontend
 * @return mixed
 */
function categories(){
    $categories = Category::orderBy('id', 'desc')->where('status', true)->get();
    return $categories;
}

/**
 * Get all published brand for frontend
 * @return mixed
 */
function brands(){
    $brands = Brand::orderBy('id', 'desc')->where('status', true)->get();
    return $brands;
}

/**
 * Get all unseen order for new order notification
 *
 * @return Order[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
 */
function showUnseenOrder(){
    $orders = Order::orderBy('id', 'desc')->with('user')->where('seen', false)->get();
    return $orders;
}

/**
 * Get product price range
 *
 * @return array
 */
function productMinAndMaxPrice(){
    $products = Product::orderBy('price', 'asc')->select('price')->get();

    return ['min_price' => isset($products->first()->price)?$products->first()->price:'', 'max_price' => isset($products->last()->price)?$products->last()->price:''];
}

/**
 * Return ago minute for order notification
 *
 * @param $timestamp
 * @return string
 * @throws Exception
 */
function timeAgo($timestamp){

    $datetime1=new DateTime();
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';

    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');
    }
    else if($diff->m > 0){
        $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
        $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
        $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
        $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
        $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }

    return $timemsg.' ago';
}
