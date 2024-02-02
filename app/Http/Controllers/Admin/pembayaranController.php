<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\pembayaranRequest;
use App\Http\Requests\pembayaranUpdateRequest;
use App\Models\pembayaran;
use App\Models\petugas;
use App\Models\siswa;
use App\Models\spp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class pembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }
    
    public function index()
    {
        $petugas = petugas::all();
        $siswa = siswa::all();
        $spp = spp::all();
        $pembayaran = pembayaran::with(['siswa', 'petugas'])->orderBy('created_at', 'desc')->get();
        return view('admin.pembayaran', compact('pembayaran', 'petugas', 'siswa', 'spp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(pembayaranUpdateRequest $request)
    {
        try {
            $request->validated();
            $data = pembayaran::where('code', $request->id)->firstOrFail();

            $data->update([
                'id_petugas' => ($request->id_petugas == null) ? $data->id_petugas : $request->id_petugas,
                'nisn' => ($request->nisn == null) ? $data->nisn : $request->nisn,
                'tgl_bayar' => ($request->tgl_bayar == null) ? $data->tgl_bayar : $request->tgl_bayar,
                'bln_bayar' => ($request->tgl_bayar == null) ? $data->bln_bayar : date('m', strtotime($request->tgl_bayar)),
                'thn_bayar' => ($request->thn_bayar == null) ? $data->thn_bayar : date('Y', strtotime($request->tgl_bayar)),
                'id_spp' => ($request->id_spp == null) ? $data->id_spp : $request->id_spp,
                'jumlah_bayar' => ($request->bayar == null) ? $data->jumlah_bayar : $request->bayar
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'pembayaran gagal di update!');
        }
        return redirect()->back()->with('success', 'pembayaran berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
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
