<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Component\fileHandlerComponent;
use App\Http\Requests\Admin\Brand\BrandRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
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
        $brands = Brand::orderBy('id', 'desc')->get();

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }
        }

        $request['status'] = ($request->status)?1:0;
        $brand = new Brand($request->all());

        if ($brand->save()){
            return redirect(route('admin.brands.index'))->with('success', 'Brand save successfully');
        }else{
            return redirect(route('admin.brands.index'))->with('success', 'Brand could not be save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return void
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($brand->image){
                $this->fileHandler->deleteImage($brand->image);
            }
        }

        $request['status'] = ($request['status'])?1:0;
        $update = $brand->update($request->all());

        if ($update){
            return redirect(route('admin.brands.index'))->with('success', 'Brand update successfully');
        }else{
            return redirect(route('admin.brands.index'))->with('success', 'Brand could not be update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Brand $brand)
    {
        if ($brand->delete()){

            //Delete image
            if ($brand->image){
                $this->fileHandler->deleteImage($brand->image);
            }

            return back()->with('success', 'Brand delete successfully');

        }else{
            return back()->with('error', 'Brand could not be delete');
        }
    }

    /**
     * Change publication status
     *
     * @param Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeStatus(Request $request, Brand $brand)
    {
        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $brand->update($request->all());

        if ($update){
            return back()->with('success', 'Brand status change successfully');
        }else{
            return back()->with('error', 'Brand status could not be change');
        }
    }
}
