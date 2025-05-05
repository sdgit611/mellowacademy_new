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

    public function hiredDevelopers()
    {
        return $this->hasManyThrough(
            Developer::class,
            DeveloperOrder::class,
            'u_id',        // Foreign key on developer_order_tb
            'dev_id',      // Foreign key on developer_details_tb
            'id',          // Local key on users table (Employer)
            'dev_id'       // Local key on developer_order_tb
        );
    }
}
