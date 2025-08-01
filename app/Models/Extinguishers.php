<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extinguishers extends Model
{
    protected $table = 'extinguishers';
    protected $fillable = [
        'created_by',
        'extinguisher_id',
        'location_id',
        'type_id',
        'serial_number',
        'capacity',
        'installation_date',
        'last_maintenance',
        'next_maintenance',
        'status',
        'qr_code_path',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function location()
    {
        return $this->belongsTo(ExtinguisherLocations::class, 'location_id');
    }

    public function type()
    {
        return $this->belongsTo(ExtinguishersTypes::class, 'type_id');
    }

    public function refillLogs()
    {
        return $this->hasMany(ExtinguisherRefill::class);
    }
    use HasFactory;
}
