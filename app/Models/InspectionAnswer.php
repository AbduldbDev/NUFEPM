<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionAnswer extends Model
{
    protected $table = 'inspection_answers';
    protected $fillable = [
        'inspection_id',
        'question_id',
        'answer',
    ];


    public function questions()
    {
        return $this->belongsTo(InspectionQuestions::class, 'question_id');
    }
}
