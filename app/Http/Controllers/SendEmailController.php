<?php

namespace App\Http\Controllers;

use App\Mail\noitify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
    {
        Mail::to('faroukious0@gmail.com', 'farouk')->send(new noitify());
        if (Mail::failures()) {
            return 'Sorry! Please try again latter';
        } else {
            return 'Great! Successfully send in your mail';
        }
    }
}
