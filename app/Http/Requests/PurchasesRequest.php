<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PurchasesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city' => 'required|string|max:255',
            'post_code' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'total_price' => 'required|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' -> 'Validation error',
                'errors' => $validator->errors(),
            ])
        );
    }

    public function messages(): array
    {
        return [
            'city.required' => 'City is required',
            'city.string' => 'City must be a string',
            'city.max' => 'City must be max 255 characters',
            'post_code.required' => 'Post code is required',
            'post_code.string' => 'Post code must be a string',
            'post_code.max' => 'Post code must be max 255 characters',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'address.max' => 'Address must be max 255 characters',
            'total_price.required' => 'Total price is required',
            'total_price.numeric' => 'Total price must be a number',
        ];
    }
}
