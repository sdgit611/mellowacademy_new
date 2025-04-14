<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'communication_score',
        'communication_remark',
        'coding_score',
        'coding_remark',
        'status',
    ];
}
