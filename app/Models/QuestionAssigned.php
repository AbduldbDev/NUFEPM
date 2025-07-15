<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAssigned extends Model
{
    protected $table = 'question_assigned';
    protected $fillable = [
        'extinguisher_id',
        'question_id',
        'assigned_by',
    ];

    public function question()
    {
        return $this->belongsTo(InspectionQuestions::class);
    }
}
