<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                    'name' => 'required|unique:brands',
                    'slug' => 'required|unique:brands'
                ];
            }

            case 'PUT' OR 'PATCH':{
                return [
                    'name' => 'required|unique:brands,name,'. $this->brand->id,
                    'slug' => 'required|unique:brands,slug,'. $this->brand->id,
                ];
            }
        }
    }
}
