<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }
    public function profile()
    {
        return view('dashboard.admin.profile');
    }
    public function setting()
    {
        return view('dashboard.admin.setting');
    }
}
