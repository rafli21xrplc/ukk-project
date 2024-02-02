<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class siswaUpdateRequest extends FormRequest
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
            'nisn' => 'required|string|max:20',
            'nis' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|numeric|digits_between:10,15',
            'id_spp' => 'required',
            'id_kelas' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.string' => 'NISN harus berupa teks.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'nisn.max' => 'NISN tidak boleh lebih dari :max karakter.',
        ];
    }
}
