<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\pembayaran;
use PDF;

class generate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function generate()
    {
        try {
            $pembayaran = pembayaran::with(['petugas', 'siswa', 'spp'])->get();
            $total = $pembayaran->sum('jumlah_bayar');

            if (empty($pembayaran)) {
                return redirect()->back()->with('warning', 'data kosong!');
            }

            $pdf = PDF::loadView('pdf.pembayaran', compact('pembayaran', 'total'));

            return $pdf->download('pembayaran.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'gagal generate pdf!');
        }
    }
}
