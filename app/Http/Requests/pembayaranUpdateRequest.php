<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class pembayaranUpdateRequest extends FormRequest
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
            'id_petugas' => 'required|exists:petugas,id',
            'nisn' => 'required|exists:siswas,id',
            'tgl_bayar' => 'required|date',
            'id_spp' => 'required|exists:spps,id',
            'bayar' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'id_petugas.required' => 'ID Petugas wajib diisi.',
            'id_petugas.exists' => 'ID Petugas tidak valid.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.exists' => 'NISN tidak valid.',
            'tgl_bayar.required' => 'Tanggal pembayaran wajib diisi.',
            'tgl_bayar.date' => 'Tanggal pembayaran harus berupa format tanggal yang valid.',
            'id_spp.required' => 'ID SPP wajib diisi.',
            'id_spp.exists' => 'ID SPP tidak valid.',
            'bayar.required' => 'Jumlah pembayaran wajib diisi.',
            'bayar.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'bayar.min' => 'Jumlah pembayaran tidak boleh kurang dari 0.',
        ];
    }
}
