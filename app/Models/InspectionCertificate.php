<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionCertificate extends Model
{
    protected $table = 'inspection_certificates';
    protected $fillable = [
        'equipment_id',
        'certificate_no',
        'file_path',
        'issue_date',
        'expiry_date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
