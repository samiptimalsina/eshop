<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Events\ReviewCreated;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//New add
use DB;
use App\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class HomeController extends Controller
{
    function __construct()
    {
        $GLOBALS['category_ids'] = [];
    }

    /**
     * Show all product
     *
     * @param Request $request
     * @return Factory|View
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

        return view('frontend.pages.home_content', compact( 'products', 'featured_products'));
    }

    /**
     * Show product by category
     *
     * @param $slug
     * @return Factory|View
     */
    function productByCategory($slug)
    {
        $category = Category::with('children')->where('slug', $slug)->first();

        array_push($GLOBALS['category_ids'], $category->id);
        $this->getChildrenCategory($category['children']);

        $products = Product::orderBy('id', 'desc')->with('brand', 'category')
            ->whereIn('category_id', $GLOBALS['category_ids'])
            ->where('status', 1)
            ->paginate(12);

        return view('frontend.pages.home_content', compact('products'));
    }

    /**
     * Get children category to get all product of category and sub category
     *
     * @param $children_categories
     */
    function getChildrenCategory($children_categories){

        foreach ($children_categories as $children_category){

            array_push($GLOBALS['category_ids'], $children_category->id);

            $this->getChildrenCategory($children_category['children']);
        }
    }

    /**
     * Show product by brand
     *
     * @param $slug
     * @return Factory|View
     */
    function productByBrand($slug)
    {
        $brand = Brand::with('products')->where('slug', $slug)->first();

        $products = $brand->products()->where('status', 1)->paginate(12);

        return view('frontend.pages.home_content', compact('products'));
    }

    /**
     * Search product from frontend
     *
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function search(Request $request){

        if (trim($request->search) != null OR $request->category != null){

            $searchBy = trim($request->search);
            $searchByCategory = $request->category;

            $products = Product::orderBy('id', 'desc')->with('brand', 'category')
                ->when($searchByCategory, function ($query, $searchByCategory) {
                    return $query->where('category_id', $searchByCategory);
                })
                ->where('status', 1)
                ->where(function ($query) use ($searchBy){
                    $query->where('name', 'LIKE', '%' . $searchBy . '%')
                        ->orWhere('slug', 'LIKE', '%' . $searchBy . '%')
                        ->orWhere('size', 'LIKE', '%' . $searchBy . '%')
                        ->orWhere('color', 'LIKE', '%' . $searchBy . '%')
                        ->orWhere('price', 'LIKE', '%' . $searchBy . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchBy . '%');
                })
                ->paginate(12);

            return view('frontend.pages.home_content', compact( 'products'));
        }else{
            return redirect('/');
        }
    }

    public function getProducts(Request $request){

        $searchBy = trim($request->search);
        $searchByCategory = $request->category;

        $products = Product::orderBy('id', 'desc')
            ->when($searchByCategory, function ($query, $searchByCategory) {
                return $query->where('category_id', $searchByCategory);
            })
            ->where('status', 1)
            ->where(function ($query) use ($searchBy){
                $query->where('name', 'LIKE', '%' . $searchBy . '%')
                    ->orWhere('slug', 'LIKE', '%' . $searchBy . '%')
                    ->orWhere('size', 'LIKE', '%' . $searchBy . '%')
                    ->orWhere('color', 'LIKE', '%' . $searchBy . '%')
                    ->orWhere('price', 'LIKE', '%' . $searchBy . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchBy . '%');
            })
            ->limit(6)->get();

        return response()->json($products);
    }

}
