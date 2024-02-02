<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\services\rechapcaService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $recaptchaService;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(rechapcaService $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
        $this->middleware('guest')->except('logout');
    }

    protected function login(loginRequest $usersRequest)
    {

        try {
            $validatedData = $usersRequest->validated();
            $user = User::where('username', $usersRequest->username)->first();
            if ($user && auth()->attempt(array_merge(['username' => $validatedData['username'], 'password' => $validatedData['password']]))) {
                switch (Auth::user()->role_id) {
                    case 1:
                        return redirect()->intended(route('dashboard.admin'));

                    case 2:
                        return redirect()->intended(route('dashboard.petugas'));

                    case 3:
                        return redirect()->intended(route('dashboard.siswa'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('messages', 'Gagal login');
        }
    }
}
