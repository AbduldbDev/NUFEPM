<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'ticket_id',
        'created_by',
        'assigned_to',
        'description',
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

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
