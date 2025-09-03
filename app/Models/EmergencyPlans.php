<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyPlans extends Model
{
    protected $table = 'emergency_plans';
    protected $fillable = [
        'building',
        'floor',
        'pdf',
    ];
}
