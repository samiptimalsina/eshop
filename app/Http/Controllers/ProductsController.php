<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{

    /**
     * Show a single product info
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $product = Product::with('category', 'brand', 'reviews')->where('slug', $slug)->first();

        $related_products = Product::with('category', 'brand')
            ->where('slug', '!=', $slug)
            ->where('category_id', $product->category->id)
            ->get();

        return view('frontend.pages.view_product', compact('product', 'related_products'));
    }

}
