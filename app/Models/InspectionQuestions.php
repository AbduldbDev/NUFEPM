<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionQuestions extends Model
{
    protected $table = 'inspection_questions';
    protected $fillable = [
        'created_by',
        'question',
        'maintenance_interval',
        'fail_reschedule_days'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
