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

    public function index()
    {
        $trash_products_qty = Product::onlyTrashed()->count();

        $products = Product::with('brand', 'category')->orderBy('id', 'desc')->get();

        return view  ('admin.product.index', compact('products', 'trash_products_qty'));
    }

    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->where('status', true)->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', true)->get();

        return view('admin.product.create', compact('categories', 'brands'));
    }

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

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->where('status', true)->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', true)->get();

        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

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

    public function trash(Product $product){

        if ($product->delete()){
            return back()->with('success', 'Product has been trashed successfully');
        }else{
            return back()->with('error', 'Product could not be trashed');
        }
    }

    public function trashList(){
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash', compact('products'));
    }

    public function restore($id){
        $product = Product::withTrashed()->find($id);

        if ($product->restore()){
            return back()->with('success', 'Product restore successfully');
        }else{
            return back()->with('error', 'Product could not be delete restore');
        }
    }

    public function bulkAction(Request $request){

        if ($request->bulk_action AND $request->product_id){

            $action = $request->bulk_action == 'restore'?'restore':'forceDelete';

            Product::onlyTrashed()
                ->whereIn('id', $request->product_id)
                ->$action();

            return back()->with('success', 'Product '.$action.' successfully');
        }

        return back();
    }

    public function destroy($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product->forceDelete()){

            //Delete image
            if ($product->image){
                $this->fileHandler->deleteImage($product->image);
            }

            return back()->with('success', 'Product delete permanently successfully');

        }else{
            return back()->with('error', 'Product could not be delete permanently');
        }
    }
}
