<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionGuideContent extends Model
{
    protected $table = 'inspection_guide_content';

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'step_number',
    ];
}
