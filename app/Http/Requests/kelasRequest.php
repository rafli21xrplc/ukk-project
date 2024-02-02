<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class kelasRequest extends FormRequest
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
    public function rules()
    {
        return [
            'kelas' => 'required|string|max:255|unique:kelas',
            'kompetensi' => 'required|string|max:255',
        ];
    }

    /**
     * Customize the error messages if needed.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'Nama sudah dibuat.',
            'name.required' => 'Nama diperlukan.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'kompetensi.required' => 'Kompetensi diperlukan.',
            'kompetensi.string' => 'Kompetensi harus berupa teks.',
            'kompetensi.max' => 'Kompetensi tidak boleh lebih dari :max karakter.',
        ];
    }
}
