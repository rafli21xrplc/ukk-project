<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\siswaRequest;
use App\Http\Requests\siswaUpdateRequest;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\spp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class siswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }
    public function index()
    {
        $siswa = siswa::with(['kelas', 'spp'])->orderBy('created_at', 'desc')->get();
        $spp = spp::all();
        $kelas = kelas::all();
        return view('admin.siswa', compact('siswa', 'spp', 'kelas'));
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
    public function store(siswaRequest $request)
    {

        try {
            $request->validated();
            $spp = spp::where('code', $request->id_spp)->firstOrFail();
            $kelas = kelas::where('code', $request->id_kelas)->firstOrFail();
            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('images/profile', 'public');
            }

            siswa::create([
                'code' => Str::uuid(),
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'name' => $request->name,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'image' => $image,
                'id_kelas' => $kelas->id,
                'id_spp' => $spp->id,
            ]);

            $siswa = siswa::where('nisn', $request->nisn)->first();

            User::create([
                'code' => Str::uuid(),
                'username' => $request->nisn,
                'password' => bcrypt($request->nis),
                'siswa_id' => $siswa->id,
                'role_id' => 3,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'siswa gagal di buat!');
        }
        return redirect()->back()->with('success', 'siswa berhasil di buat!');
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
    public function update(siswaUpdateRequest $request)
    {
        try {
            $data = siswa::where('code', $request->id)->firstOrFail();

            if ($request->hasFile('image')) {
                if ($request->image && Storage::disk('public')->exists($data->image)) {
                    Storage::disk('public')->delete($data->image);
                }
                $newImage = $request->file('image')->store('images/profile', 'public');
            }

            $data->update([
                'nisn' => $request->nisn ?? $data->nisn,
                'nis' => $request->nis ?? $data->nis,
                'name' => $request->name ?? $data->name,
                'alamat' => $request->alamat ?? $data->alamat,
                'telp' => $request->telp ?? $data->telp,
                'id_kelas' => $request->id_kelas ?? $data->id_kelas,
                'id_spp' => $request->id_spp ?? $data->id_spp,
                'image' => $newImage ?? $data->image,
                'update_at' => Carbon::now()
            ]);

            User::where('siswa_id', $data->id)->first()->update([
                'username' => ($request->nisn == null) ? $data->nisn : $request->nisn,
                'password' => ($request->nis == null) ? bcrypt($data->nis) : bcrypt($request->nis),
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'siswa gagal di update!');
        }
        return redirect()->back()->with('success', 'siswa berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = siswa::where('code', $id)->firstOrFail();
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }
            $data->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'siswa gagal di hapus!');
        }
        return redirect()->back()->with('success', 'siswa berhasil di hapus!');
    }
}
