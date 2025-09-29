<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyHotline extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'number',
        'label',
    ];
}
