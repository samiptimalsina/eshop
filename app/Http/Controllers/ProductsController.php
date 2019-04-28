<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductsController extends Controller
{
    function __construct()
    {
        $GLOBALS['parent_categories'] = [];
    }

    /**
     * Show a single product info
     *
     * @param $slug
     * @return Factory|View
     */
    public function show($slug)
    {
        $product = Product::with('category', 'brand')->where('slug', $slug)->first();

        $related_products = Product::with('category', 'brand')
            ->where('slug', '!=', $slug)
            ->where('category_id', $product->category->id)
            ->get();

        return view('frontend.pages.view_product', compact('product', 'related_products'));
    }

    /**
     * Get product info for quick view
     *
     * @param $id
     * @return Product[]|Builder[]|Collection
     */
    public function getProductInfo($id){

        $product = Product::with('brand', 'category')->where('id', $id)->first();

       return $product;
    }

    /**
     * Get parent category for select category in sidebar
     *
     * @param $category
     * @return false|string
     */
    function getParentCategory($category){

        $parent_id = Category::where('name', $category)->select('parent_id')->first();

        if(isset($parent_id['parent_id'])){

            $parent_category = Category::where('id', $parent_id['parent_id'])->first();

            array_push($GLOBALS['parent_categories'], $parent_category['name']);

            if (isset($parent_category['parent_id'])){
                getParentCategory($parent_category['name']);
            }
        }

        return json_encode($GLOBALS['parent_categories']);
    }

    /**
     * Get product category for select category in view_product
     *
     * @param $product_slug
     * @return false|string
     */
    function getProductCategorySlug($product_slug){

        $product = Product::with(['category' => function($query){
                    $query->select('id','slug');
                }])->where('slug', $product_slug)
                ->first();

        return $product->category->slug;
    }
}
