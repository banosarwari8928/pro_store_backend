<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProudctUpdateREq extends FormRequest
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
             'name'=> 'nullable|string|min:3',
            'price'=> 'nullable|decimal|min:10|max:19000',
            'stock'=> 'nullable|integer|min:1|max:200',
            'brand'=> 'nullable|string|min:3',
            'description'=> 'nullable|string|min:10',
            'category'=> 'nullable|string|min:10',
            'img_url'=>"nullable|string",
            'imageable_type'=>'required|string',
            'imageable_id'=>'required|string'

        ];
    }
}
