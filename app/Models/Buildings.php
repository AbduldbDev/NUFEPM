<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buildings extends Model
{
    protected $table = 'location_buildings';
    protected $fillable = [
        'name',
        'icon',
        'description',
    ];

    public function locations()
    {
        return $this->hasMany(ExtinguisherLocations::class, 'building', 'name');
    }

    public function devices()
    {
        return $this->hasManyThrough(
            Equipment::class,
            ExtinguisherLocations::class,
            'building',
            'loc_id',
            'name',
            'id'
        );
    }

    public function extinguishers()
    {
        return $this->hasManyThrough(
            Extinguishers::class,
            ExtinguisherLocations::class,
            'building',
            'location_id',
            'name',
            'id'
        );
    }
}
