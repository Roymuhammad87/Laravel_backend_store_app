<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'user_id'=>'required|integer|exists:users,id',
            'phone'=>'required|string',
            'image'=>'required|image|mimes:jpg,png,jpeg',
            'longitude'=>'required|decimal:2,2',
            'latitude'=>'required|decimal:2,2',
        ];
    }
}
