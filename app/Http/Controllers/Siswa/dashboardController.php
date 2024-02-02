<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\pembayaran;
use App\Models\petugas;
use App\Models\siswa;
use App\Models\spp;
use Illuminate\Support\Facades\Auth;
use PDF;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    protected function index()
    {
        $petugas = petugas::all();
        $siswa = siswa::all();
        $spp = spp::all();
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])
            ->where('nisn', Auth::user()->siswa_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('siswa.dashboard', compact('petugas', 'siswa', 'spp', 'pembayaran'));
    }

    protected function generate(string $id)
    {
        try {
            $pembayaran = pembayaran::with(['petugas', 'siswa', 'spp'])->where('nisn', $id)->get();
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
