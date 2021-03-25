<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class restaurantValidate extends FormRequest
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
        return [
            
            // FINAL VALIDATION
            'restaurantName' => 'required|string|min:3|max:50',//|unique:restaurants,name per mettero questa validazione devo fare validazioni separate per create e update
            'restaurantAddress' => 'required|string|min:3|max:100',
            'restaurantDescription' => 'required|string|min:10|max:100',
            'restaurantImgUrl' => 'nullable|mimetypes:image/jpeg,image/png|max:2048',
            'restaurantDeliveryHours' => 'required|string',
            'restaurantCloseDay' => 'required|string',
            'restaurantShortDescription' => 'required|string|min:10|max:40',
            'restaurantPhone' => 'required|numeric',
            'restaurantCity' => 'required|alpha',
            'cuisinetypes' => 'required'
        ];
    }
}
