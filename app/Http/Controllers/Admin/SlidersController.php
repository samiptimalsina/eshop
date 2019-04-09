<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Component\fileHandlerComponent;
use App\Http\Requests\Admin\Slider\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlidersController extends Controller
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
       $sliders = Slider::orderBy('id', 'desc')->get();

       return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }
        }

        $request['status'] = ($request->status)?1:0;
        $brand = new Slider($request->all());

        if ($brand->save()){
            return redirect(route('admin.sliders.index'))->with('success', 'Slider save successfully');
        }else{
            return redirect(route('admin.sliders.index'))->with('success', 'Slider could not be save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Slider $slider
     * @return void
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        if ($request->img){
            $image_name = $this->fileHandler->imageUpload($request->file('img'), 'img');

            if ($image_name){
                $request['image'] = $image_name;
            }

            //Delete old image
            if ($slider->image){
                $this->fileHandler->deleteImage($slider->image);
            }
        }

        $request['status'] = ($request['status'])?1:0;
        $update = $slider->update($request->all());

        if ($update){
            return redirect(route('admin.sliders.index'))->with('success', 'Slider update successfully');
        }else{
            return redirect(route('admin.sliders.index'))->with('success', 'Slider could not be update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Slider $slider)
    {
        if ($slider->delete()){

            //Delete old image
            if ($slider->image){
                $this->fileHandler->deleteImage($slider->image);
            }

            return back()->with('success', 'Slider delete successfully');
        }else{
            return back()->with('error', 'Slider could not be delete');
        }
    }

    /**
     * Change publication status
     *
     * @param Request $request
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */

    public function changeStatus(Request $request, Slider $slider)
    {
        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $slider->update($request->all());

        if ($update){
            return back()->with('success', 'Slider status change successfully');
        }else{
            return back()->with('error', 'Slider status could not be change');
        }
    }
}
