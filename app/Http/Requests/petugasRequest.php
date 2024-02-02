<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class petugasRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:petugas',
            'nama_petugas' => 'required|string|max:255',
            'level' => 'required|in:admin,petugas',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.unique' => 'Username sudah digunakan.',
            'username.max' => 'Username tidak boleh lebih dari :max karakter.',
            'nama_petugas.required' => 'nama_petugas wajib diisi.',
            'nama_petugas.string' => 'nama_petugas harus berupa teks.',
            'nama_petugas.unique' => 'nama_petugas sudah digunakan.',
            'nama_petugas.max' => 'nama_petugas tidak boleh lebih dari :max karakter.',
            'level.required' => 'Level wajib diisi.',
            'level.in' => 'Level harus memiliki nilai "admin" atau "petugas".',
        ];
    }
}
