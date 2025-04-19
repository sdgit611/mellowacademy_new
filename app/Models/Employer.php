<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $table = 'user_login'; // point to the correct table

    protected $fillable = [
        'fname', 'email', 'password', // include other fields if needed
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false; // if `user_login` doesn't have created_at/updated_at
}
