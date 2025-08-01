<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class CompanyProject extends Pivot
{
    protected $table = 'company_project';
    protected $fillable = [
        'person_id',
        'project_id',
        'status_id',
        'company_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }    
} 