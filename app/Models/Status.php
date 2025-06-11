<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{

    use HasFactory;
    protected $fillable = [
        'status',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_project');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(project::class);
    }


    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('company_id');
    }
    
    const STATUS_ACTIVE = 'active';
    const STATUS_CONTRACT = 'contract';
    const STATUS_CANCELLED = 'cancelled';

    public static $statuses = [
        'active' => '進行中',
        'contract' => '受注',
        'cancelled' => '失注'
    ];
}
