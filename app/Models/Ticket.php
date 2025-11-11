<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{


    // Table name (optional if follows Laravel convention)
    protected $table = 'tickets';

    // Mass assignable fields
    protected $fillable = [
        'ticket_id',
        'extinguisher_id',
        'created_by',
        'assigned_to',
        'instructions',
        'remarks',
        'images',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'images' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function extinguisher()
    {
        return $this->belongsTo(Extinguishers::class, 'extinguisher_id');
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
