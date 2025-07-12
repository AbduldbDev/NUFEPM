<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extinguishers extends Model
{
    protected $table = 'fire_extinguishers';
    protected $fillable = [
        'extinguisher_id',
        'serial_number',
        'type',
        'capacity',
        'location',
        'installation_date',
        'last_maintenance',
        'next_maintenance',
        'status',
        'qr_code_path',
    ];

    use HasFactory;
}
