<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_en' => 'required|max:100',
            'name_fr' => 'required|max:100',
            'price' => 'required|numeric',
            'details_en' => 'required',
            'details_fr' => 'required'
        ];
    }

    public function messages()
    {
        return [
        'name.required' => __('offers.name.required'),
        'name.max' => __('offers.name.max'),
        'price.required' => __('offers.price.required'),
        'price.numeric' => __('offers.price.numeric'),
        'details' => __('offers.details'),
    ];
    }
}
