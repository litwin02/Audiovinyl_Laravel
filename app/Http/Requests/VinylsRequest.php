<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VinylsRequest extends FormRequest
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
            'title' => 'required|String|max:255|',
            'description' => 'required|String|max:255|',
            'artist_id' => 'exists:artists,id',
            'genre_id' => 'exists:genres,id',
            'quantity' => 'required|Numeric|',
            'price' => 'required|Numeric|',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'message' => 'Validation error',
            'errors' => $validator->errors(),
        ]));
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.String' => 'Title must be a string',
            'title.max' => 'Title must be max 255 characters',
            'description.required' => 'Description is required',
            'description.String' => 'Description must be a string',
            'description.max' => 'Description must be max 255 characters',
            'artist_id.exists' => 'Artist must exist',
            'genre_id.exists' => 'Genre must exist',
            'price.required' => 'Price is required',
            'price.Numeric' => 'Price must be a number',
        ];
    }
}
