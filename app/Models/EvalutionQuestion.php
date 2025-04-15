<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EvalutionAnswer;


class EvalutionQuestion extends Model
{
    use HasFactory;

    public function getEvalutionanswer()
    {
    	return $this->hasOne(EvalutionAnswer::class,'question_id','id');
    }
}
