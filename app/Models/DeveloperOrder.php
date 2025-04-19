<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperOrder extends Model
{
    use HasFactory;

    protected $table = 'developer_order_tb';

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'dev_id', 'dev_id');
    }
}
