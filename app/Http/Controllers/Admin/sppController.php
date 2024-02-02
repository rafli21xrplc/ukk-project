<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\sppRequest;
use App\Http\Requests\sppUpdateRequest;
use App\Models\spp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class sppController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }
    public function index()
    {
        $spp = spp::orderBy('created_at', 'desc')->get();
        return view('admin.spp', compact('spp'));
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
    public function store(sppRequest $request)
    {
        $request->validated();
        try {
            spp::create([
                'code' => Str::uuid(),
                'tahun' => $request->tahun,
                'nominal' => $request->nominal,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'spp gagal di buat!');
        }
        return redirect()->back()->with('success', 'spp berhasil di buat!');
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
    public function update(sppUpdateRequest $request)
    {
        try {
            $data = spp::where('code', $request->id)->firstOrFail();
    
            $data->update([
                'tahun' => ($request->tahun == null) ? $data->tahun : $request->tahun,
                'nominal' => ($request->nominal == null) ? $data->nominal : $request->nominal,
                'update_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'spp gagal di update!');
        }
        return redirect()->back()->with('success', 'spp berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = spp::where('code', $id)->firstOrFail();
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'spp gagal di hapus!');
        }
        return redirect()->back()->with('success', 'spp berhasil di hapus!');
    }
}
