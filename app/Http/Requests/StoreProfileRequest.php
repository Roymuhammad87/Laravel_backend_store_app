<?php

namespace App\Http\Requests;

use ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreProfileRequest extends FormRequest
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
     * Get validation errors
     */

     public function failedValidation(Validator $validator){

        if($this->is('api/*')) {
            $response = ApiResponse::apiResponse(422, 'Validation Errors Found', $validator->getMessageBag()->all());
             throw new ValidationException($validator,$response );
        }

     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){

        return [
        'user_id'=>'required|integer|exists:users,id',
        'phone'=>'nullable|string',
        'image'=>'nullable|image|mimes:jpg,png,jpeg',
        'longitude'=>'nullable|decimal:2,10',
        'latitude'=>'nullable|decimal:2,10',
        ];
   }
}
