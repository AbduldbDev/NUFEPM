<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtinguisherRefill extends Model
{
    protected $table = 'extinguisher_refills';
    protected $fillable = [
        'extinguisher_id',
        'refill_by',
        'refill_date',
        'remarks',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'refill_by');
    }

    public function extinguisher()
    {
        return $this->belongsTo(Extinguishers::class, 'extinguisher_id');
    }
}
