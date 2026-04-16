<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=> ['required' ,'string','min:3', Rule::unique('products','name')],
            'price'=> 'required|numaric|min:10|max:19000',
            'stock'=> 'required|integer|min:1|max:200',
            'brand'=> 'required|string',
            'description'=> 'required|string|min:10',
            'category'=> 'required|string|min:10',
        ];
    }
}
