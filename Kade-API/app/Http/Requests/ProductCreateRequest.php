<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->seller == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image_url' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'min:10'],
            'quantity' => ['required', 'numeric'],
            'unit' => ['required', 'string', 'max:50'],
            'unit_price' => ['required', 'numeric'],
        ];
    }
}
