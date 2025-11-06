<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $fillable = [
        'created_by',
        'type',
        'model',
        'serial_number',
        'loc_id',
        'installation_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function location()
    {
        return $this->belongsTo(ExtinguisherLocations::class, 'loc_id');
    }

    public function certificate()
    {
        return $this->hasMany(InspectionCertificate::class, 'equipment_id', 'id');
    }
    
    public function latestCertificate()
    {
        return $this->hasOne(InspectionCertificate::class, 'equipment_id', 'id')
            ->latest('created_at');
    }
}
