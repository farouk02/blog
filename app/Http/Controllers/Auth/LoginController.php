<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (Auth()->user()->role === 0) {
            return redirect(route('user.dashboard', App::currentLocale()));
        } elseif (Auth()->user()->role === 1) {
            return redirect(route('admin.dashboard', App::currentLocale()));
        }
    }


    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            if (Auth()->user()->role === 0) {
                return redirect()->route('admin.dashboard', App::currentLocale());
            } elseif (Auth()->user()->role === 1) {
                return redirect()->route('user.dashboard', App::currentLocale());
            }
        } else {
            return redirect()->route('login')->with('error', __('Email Or Password are wrong'));
        }
    }

    protected function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login', App::currentLocale()));
    }
}
