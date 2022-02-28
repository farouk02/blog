<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (Auth()->user()->role === 0) {
            return redirect(RouteServiceProvider::USER);
        } elseif (Auth()->user()->role === 1) {
            return redirect(RouteServiceProvider::ADMIN);
        }
    }


    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (auth()->attempt(array('username' => $input['email'], 'password' => $input['password']))) {
            $user = User::find(Auth::id());
            $user->expired = 0;
            $user->save();

            if (Auth()->user()->role === 0) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth()->user()->role === 1) {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->route('login')->with('error', __('Email Or Password are wrong'));
        }
    }
}
