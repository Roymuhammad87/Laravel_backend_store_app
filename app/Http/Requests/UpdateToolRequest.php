<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToolRequest extends FormRequest
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
            'name'=>'required|string|min:3',
            'description'=>'required|string|min:5',
            'price'=>'nullable|integer',
            'state'=>'nullable|boolean',
            'categoryName'=>'required|string',
            // 'images.*'=>['nullable', 'image', 'mimes:jpg,png,jpeg']
        ];
    }
}
