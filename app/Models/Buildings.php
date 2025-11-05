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
}
