<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductsController extends Controller
{

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

}
