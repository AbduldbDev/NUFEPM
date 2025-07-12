<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtinguishersTypes extends Model
{
    protected $table = 'extinguishers_type';
    protected $fillable = [
        'created_by',
        'name',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
