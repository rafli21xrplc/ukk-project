<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\kelasRequest;
use App\Http\Requests\kelasUpdateRequest;
use App\Models\kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class kelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }

    public function index()
    {
        $kelas = kelas::orderBy('created_at', 'desc')->get();
        return view('admin.kelas', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(kelasRequest $request)
    {
        $request->validated();
        try {
            Kelas::create([
                'code' => Str::uuid(),
                'kelas' => $request->kelas,
                'kompetensi_keahlian' => $request->kompetensi,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'kelas gagal di buat!');
        }
        return redirect()->back()->with('success', 'kelas berhasil di buat!');
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
    public function update(kelasUpdateRequest $request)
    {
        try {
            $data = kelas::where('code', $request->id)->firstOrFail();
    
            $data->update([
                'kelas' => ($request->kelas == null) ? $data->kelas : $request->kelas,
                'kompetensi_keahlian' => ($request->kompetensi == null) ? $data->kompetensi_keahlian : $request->kompetensi,
                'update_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'kelas gagal di update!');
        }
        return redirect()->back()->with('success', 'kelas berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = kelas::where('code', $id)->firstOrFail();
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'kelas gagal di hapus!');
        }
        return redirect()->back()->with('success', 'kelas berhasil di hapus!');
    }
}
