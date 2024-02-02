<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Http\Requests\pembayaranRequest;
use App\Models\pembayaran;
use App\Models\petugas;
use App\Models\siswa;
use App\Models\spp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('petugas');
    }

    protected function index()
    {
        $petugas = petugas::all();
        $siswa = siswa::all();
        $spp = spp::all();
        $pembayaran = Pembayaran::with(['siswa', 'petugas'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('petugas.dashboard', compact('petugas', 'siswa', 'spp', 'pembayaran'));
    }

    public function store(pembayaranRequest $request)
    {
        try {
            $request->validated();
            $petugas = petugas::where('code', $request->id_petugas)->first();
            $siswa = siswa::where('code', $request->nisn)->first();
            $spp = spp::where('code', $request->id_spp)->first();
    
            pembayaran::create([
                'code' => Str::uuid(),
                'id_petugas' => $petugas->id,
                'nisn' => $siswa->id,
                'tgl_bayar' => $request->tgl_bayar,
                'bln_bayar' => date('m', strtotime($request->tgl_bayar)),
                'thn_bayar' => date('Y', strtotime($request->tgl_bayar)),
                'id_spp' => $spp->id,
                'jumlah_bayar' => $request->bayar
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'pembayaran gagal di buat!');
        }
        return redirect()->back()->with('success', 'pembayaran berhasil di buat!');
    }

    public function destroy(string $id)
    {
        try {
            $data = pembayaran::where('code', $id)->firstOrFail();
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'pembayaran gagal di hapus!');
        }
        return redirect()->back()->with('success', 'pembayaran berhasil di hapus!');
    }
}
