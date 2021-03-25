<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderValidate extends FormRequest
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
            'orderName' => 'required|string|min:3|max:50',
            'orderSurname' => 'required|string|min:3|max:50',
            'orderAddress' => 'required|string|min:3|max:100',
            'orderPhone' => 'required|numeric',
            'orderEmail' => 'required|string|email|max:255',
            'orderNotes' => 'nullable|string|max:255',
        ];
    }
}
