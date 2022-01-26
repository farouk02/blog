<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;
    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected function redirectTo()
    {
        if (Auth()->user()->role === 0) {
            return route('admin.dashboard', App::currentLocale());
        } elseif (Auth()->user()->role === 1) {
            return route('user.dashboard', App::currentLocale());
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
