<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionLogs extends Model
{
    protected $table = 'inspection_logs';
    protected $fillable = [
        'extinguisher_id',
        'inspected_by',
        'inspected_at',
        'next_due',
        'time',
        'status',
        'remarks',
    ];

    public function extinguisher()
    {
        return $this->belongsTo(Extinguishers::class, 'extinguisher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }
}
