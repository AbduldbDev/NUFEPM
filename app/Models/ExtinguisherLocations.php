<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtinguisherLocations extends Model
{
    protected $table = 'extinguisher_locations';
    protected $fillable = [
        'created_by',
        'icon',
        'building',
        'floor',
        'room',
        'spot',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function extinguishers()
    {
        return $this->hasMany(Extinguishers::class, 'location_id', 'id');
    }
}
