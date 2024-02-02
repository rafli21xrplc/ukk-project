<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'auth']);
    }

    protected function index()
    {
        // dd(Auth::check());
        return view('admin.dashboard');
    }
}
