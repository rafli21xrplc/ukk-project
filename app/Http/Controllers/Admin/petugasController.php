<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\petugasRequest;
use App\Models\petugas;
use App\Models\role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class petugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }
    public function index()
    {
        $petugas = petugas::orderBy('created_at', 'desc')->get();
        return view('admin.petugas', compact('petugas'));
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
    public function store(petugasRequest $request)
    {
        $request->validated();
        petugas::create([
            'code' => Str::uuid(),
            'username' => $request->username,
            'password' => bcrypt('password'),
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level
        ]);
        $petugas = petugas::where('username', $request->username)->first();
        User::create([
            'code' => Str::uuid(),
            'username' => $request->username,
            'password' => bcrypt('password'),
            'petugas_id' => $petugas->id,
            'role_id' => 2,
        ]);
        try {
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'petugas gagal di buat!');
        }
        return redirect()->back()->with('success', 'petugas berhasil di buat!');
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
    public function update(petugasRequest $request)
    {
        try {
            $data = petugas::where('code', $request->id)->firstOrFail();

            $data->update([
                'username' => $request->username ?? $data->username,
                'nama_petugas' => $request->nama_petugas ?? $data->nama_petugas,
                'level' => $request->level ?? $data->level,
                'update_at' => Carbon::now()
            ]);

            User::where('petugas_id', $data->id)->update([
                'username' => $request->username ?? $data->username,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'petugas gagal di update!');
        }
        return redirect()->back()->with('success', 'petugas berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $petugas = petugas::where('code', $id)->firstOrFail();
            User::where('petugas_id', $petugas->id)->delete();
            $petugas->delete(); 
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'petugas gagal di hapus!');
        }
        return redirect()->back()->with('success', 'petugas berhasil di hapus!');
    }
}
