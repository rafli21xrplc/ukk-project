<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sppRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tahun' => 'required|integer|min:1900|unique:spps|max:' . date('Y'),
            'nominal' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'unique' => 'Kolom :sudah dibuat.',
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka bulat.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'min' => [
                'numeric' => 'Kolom :attribute tidak boleh kurang dari :min.',
            ],
            'max' => [
                'numeric' => 'Kolom :attribute tidak boleh lebih dari :max.',
            ],
        ];
    }
}
