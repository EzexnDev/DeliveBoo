<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class menuItemValidate extends FormRequest
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
            //FINAL VALIDATION
            'menuItemName' => 'required|string|min:3|max:50',//|unique:menuitems,name name per mettero questa validazione devo fare validazioni separate per create e update
            'menuItemDescription' => 'required|string|min:10|max:50',
            //'menuItemIngredients' => 'required|string|max:50',
            'menuItemPrice' => 'required|numeric',
            'options' => 'required'

            //TESTING VALIDATION
            /* 'menuItemName' => 'required',
            'menuItemDescription' => 'required',
            'menuItemIngredients' => 'required',
            'menuItemPrice' => 'required', */
        ];
    }

    //messaggi di errore customizzati gestiti con resources/lang/en/validation.php
}
