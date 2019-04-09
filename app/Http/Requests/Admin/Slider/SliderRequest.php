<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()){

            case 'POST':{
                return [
                    'name' => 'required|unique:sliders',
                ];
            }

            case 'PUT' OR 'PATCH':{
                return [
                    'name' => 'required|unique:sliders,name,'. $this->slider->id,
                ];
            }
        }
    }
}
