<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSticker extends FormRequest
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
            'category' => 'required',
            'title' => 'required|unique:stikers,title',
            'tags' => 'required',
            'premium' => 'required',
            'icons.*' => "required|image|mimes:jpg,png,jpeg|max:20000",
            'stikers.*' => "required|image|mimes:jpg,png,jpeg|max:20000"

        ];
    }
}
