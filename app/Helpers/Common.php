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
 * Get all published slider for fronted
 * @return mixed
 */
function sliders(){
    $sliders = Slider::orderBy('id', 'desc')->where('status', true)->get();
    return $sliders;
}

/**
 * Get all published parent category for frontend
 * @return mixed
 */
function getParentCategories(){
    $parent_categories = Category::with('children', 'products')->orderBy('id', 'desc')
        ->where('status', true)->where('parent_id', null)->get();

    return $parent_categories;
}

/**
 * Get all published all category for frontend
 * @return mixed
 */
function getAllCategories(){
    $categories = Category::orderBy('id', 'desc')
        ->where('status', true)->get();

    return $categories;
}

/**
 * Get all published brand for frontend
 * @return mixed
 */
function brands(){
    $brands = Brand::orderBy('id', 'desc')
        ->withCount(['products' => function($query){
            $query->where('status', 1);
        }])->where('status', true)->get();

    return $brands;
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


