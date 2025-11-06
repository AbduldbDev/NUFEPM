<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SOSReport extends Model
{
    use HasFactory;

    protected $table = 'sos_reports';

    protected $fillable = [
        'user_id',
        'location',
        'description',
        'image',
        'date_time',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
