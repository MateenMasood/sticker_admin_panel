<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomType extends FormRequest
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
            'hotelId' => 'required|numeric',
            'roomType' => 'required',
            'amenities' => 'required',
            'description' => 'required',
            'pricePerRoom' => 'required|numeric',
            'tax' => 'required|numeric',
        ];
    }
}
