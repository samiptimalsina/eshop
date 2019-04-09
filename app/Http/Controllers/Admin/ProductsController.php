<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Component\fileHandlerComponent;
use App\Http\Requests\Admin\Product\ProductCreateRequest;
use App\Http\Requests\Admin\Product\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public $fileHandler;

    function __construct()
    {
        $this->fileHandler = new fileHandlerComponent();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('brand', 'category')->orderBy('id', 'desc')->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->where('status', true)->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', true)->get();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }
        }

        $request['status'] = ($request->status)?1:0;
        $request['featured'] = ($request->featured)?1:0;
        $product = new Product($request->all());

        if ($product->save()){
            return redirect(route('admin.products.index'))->with('success', 'Product save successfully');
        }else{
            return redirect(route('admin.products.index'))->with('success', 'Product could not be save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->where('status', true)->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', true)->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($product->image){
                $this->fileHandler->deleteImage($product->image);
            }
        }

        $request['status'] = ($request->status)?1:0;
        $request['featured'] = ($request->featured)?1:0;
        $update = $product->update($request->all());

        if ($update){
            return redirect(route('admin.products.index'))->with('success', 'Product save successfully');
        }else{
            return redirect(route('admin.products.index'))->with('success', 'Product could not be save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if ($product->delete()){

            //Delete image
            if ($product->image){
                $this->fileHandler->deleteImage($product->image);
            }

            return back()->with('success', 'Product delete successfully');

        }else{
            return back()->with('error', 'Product could not be delete');
        }
    }

    /**
     * Change publication status
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeStatus(Request $request, Product $product)
    {
        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $product->update($request->all());

        if ($update){
            return back()->with('success', 'Product status change successfully');
        }else{
            return back()->with('error', 'Product status could not be change');
        }
    }


    /**
     * Change publication status
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeFeatured(Request $request, Product $product)
    {
        $request['featured'] = ($request['old'] == 1)?0:1;
        $update = $product->update($request->all());

        if ($update){
            return back()->with('success', 'Product add to featured successfully');
        }else{
            return back()->with('error', 'Product could not be add featured');
        }
    }
}
