<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $fillable = [
        'type',
        'model',
        'serial_number',
        'loc_id',
        'installation_date',
        'status'
    ];
    public function location()
    {
        return $this->belongsTo(ExtinguisherLocations::class, 'loc_id');
    }
}
