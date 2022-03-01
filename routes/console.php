<?php

use App\Mail\noitify;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('user:expire', function () {
    $users = User::where('expired', 0)->get();
    foreach ($users as $user) {
        $user->expired = 1;
        $user->save();
        $email =  $user->email;

        Mail::to($email)->send(new noitify());
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return response()->success('Great! Successfully send in your mail');
        }
    }
});
