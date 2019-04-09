<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use Illuminate\Http\Request;
//New add
use DB;
use App\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show all product
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index(Request $request){

        $products = Product::orderBy('id', 'desc')->with('brand', 'category')
            ->where('status',1)
            ->paginate(12);

        if ($request->min_price OR $request->max_price)
        {
            $products = Product::orderBy('id', 'desc')->with('brand', 'category')
                ->where('status', 1)
                ->whereBetween('price', [$request->min_price, $request->max_price])
                ->paginate(12);
        }

        $featured_products = Product::orderBy('id', 'desc')->with('brand', 'category')
            ->where(['status' => 1, 'featured' => true])->get();

        return view('frontend.pages.homeContent', compact( 'products', 'featured_products'));
    }

    /**
     * Show product by category
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function productByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = product::with('brand', 'category')
            ->where(['status' => 1, 'category_id' => $category->id])
            ->paginate(6);

        return view('frontend.pages.homeContent', compact('products'));
    }

    /**
     * Show product by brand
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function productByBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->first();

        $products = product::with('brand', 'category')
            ->where('status', 1)
            ->where('brand_id', $brand->id)
            ->paginate(6);

        return view('frontend.pages.homeContent', compact('products'));
    }

    /**
     * Search product from frontend
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search(Request $request){

        $searchBy = $request->search;

        $products = Product::orderBy('id', 'desc')->with('brand', 'category')
            ->where('status',1)
            ->where('name', 'LIKE', '%' . $searchBy . '%')
            ->where('slug', 'LIKE', '%' . $searchBy . '%')
            ->orWhere('size', 'LIKE', '%' . $searchBy . '%')
            ->orWhere('color', 'LIKE', '%' . $searchBy . '%')
            ->orWhere('price', 'LIKE', '%' . $searchBy . '%')
            ->orWhere('description', 'LIKE', '%' . $searchBy . '%')
            ->paginate(6);

        return view('frontend.pages.homeContent', compact( 'products'));
    }


    /**
     * Get product info for quick view
     *
     * @param product $product
     */
    public function getProductInfo($id){

        $product = Product::with('brand', 'category')->where('id', $id)->get();

        echo $product;die;
    }
}
