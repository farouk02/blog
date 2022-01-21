<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'bio',
        'fb_profile',
    ];


    protected $dates = [
        'birth_day',
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
