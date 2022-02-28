<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;


Artisan::command('user:expire', function () {
    $users = User::where('expired', 0)->get();
    foreach ($users as $user) {
        $user->expired = 1;
        $user->save();
    }
})->purpose('Your login Expired. Please reSign in!');
