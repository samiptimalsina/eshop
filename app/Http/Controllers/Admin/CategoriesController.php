<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Component\fileHandlerComponent;
use App\Http\Requests\Admin\Category\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
        $categories = Category::with('products')->orderBy('id', 'desc')->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }
        }

        $request['status'] = ($request->status)?1:0;
        $category = new Category($request->all());

        if ($category->save()){
            return redirect(route('admin.categories.index'))->with('success', 'Category save successfully');
        }else{
            return redirect(route('admin.categories.index'))->with('success', 'Category could not be save');
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
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($category->image){
                $this->fileHandler->deleteImage($category->image);
            }
        }

        $request['status'] = ($request['status'])?1:0;
        $update = $category->update($request->all());

        if ($update){
            return redirect(route('admin.categories.index'))->with('success', 'Category update successfully');
        }else{
            return redirect(route('admin.categories.index'))->with('success', 'Category could not be update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->delete()){

            //Delete image
            if ($category->image){
                $this->fileHandler->deleteImage($category->image);
            }

            return back()->with('success', 'Category delete successfully');

        }else{
            return back()->with('error', 'Category could not be delete');
        }
    }

    /**
     * Change publication status
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeStatus(Request $request, Category $category)
    {
        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $category->update($request->all());

        if ($update){
            return back()->with('success', 'Category status change successfully');
        }else{
            return back()->with('error', 'Category status could not be change');
        }
    }
}
