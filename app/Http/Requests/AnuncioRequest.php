<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnuncioRequest extends FormRequest
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
            'titulo' => 'required|string|max:255|min:3',
            'descripcion' => 'required|string|max:500|min:3',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'required|file|image|mimes:jpg,png,gif,webp|max:2048'
        ];
    }
}
