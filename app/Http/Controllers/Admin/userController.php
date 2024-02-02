<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\sendEmailRegisterJob;
use App\Mail\ConfirmationEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->where('role_id', 2)->where('email_verified_at', null)->get();
        return view('admin.profile', compact('users'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::where('code', $id)->first();
            $user->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User gagal di hapus!');
        }
        return redirect()->back()->with('success', 'User berhasil di hapus!');
    }

    protected function approve(string $id)
    {
        try {
            $user = User::where('code', $id)->first();
            $user->update([
                'email_verified_at' => Carbon::now()
            ]);

            dispatch(new sendEmailRegisterJob($user));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Email gagal di kirim!');
        }
        return redirect()->back()->with('success', 'Email berhasil di kirim!');
    }
}
