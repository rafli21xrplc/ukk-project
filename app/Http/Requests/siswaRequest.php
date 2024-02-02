<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class siswaRequest extends FormRequest
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
            'nisn' => 'required|string|unique:siswas,nisn|max:20',
            'nis' => 'required|string|unique:siswas,nis|max:20',
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|numeric|digits_between:10,15',
            'id_spp' => 'required',
            'id_kelas' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example image upload validation
        ];
    }

    public function messages()
    {
        return [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.string' => 'NISN harus berupa teks.',
            'nisn.unique' => 'NISN sudah digunakan.',
            'nisn.max' => 'NISN tidak boleh lebih dari :max karakter.',

            'nis.required' => 'NIS wajib diisi.',
            'nis.string' => 'NIS harus berupa teks.',
            'nis.unique' => 'NIS sudah digunakan.',
            'nis.max' => 'NIS tidak boleh lebih dari :max karakter.',

            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari :max karakter.',

            'telp.required' => 'Nomor telepon wajib diisi.',
            'telp.numeric' => 'Nomor telepon harus berupa angka.',
            'telp.digits_between' => 'Nomor telepon harus memiliki panjang antara :min dan :max digit.',

            'id_spp.required' => 'Pilih SPP wajib diisi.',

            'id_kelas.required' => 'Pilih Kelas wajib diisi.',

            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
        ];
    }
}
