<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_project',
        'project_id'
    ];

    const PROJECT_TYPE_P_CARE = 'Pカレ';
    const PROJECT_TYPE_CONSULTING = 'コンサル';
    const PROJECT_TYPE_SMART_ROBOT = 'スマロボ';

    public static $projectTypes = [
        self::PROJECT_TYPE_P_CARE => 'Pカレ',
        self::PROJECT_TYPE_CONSULTING => 'コンサル',
        self::PROJECT_TYPE_SMART_ROBOT => 'スマロボ'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)
                    ->withPivot('status_id')
                    ->withTimestamps();
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'company_project')
                    ->withPivot('status_id')
                    ->withTimestamps();
    }

    public function scopeSearch($query, $filters = [])
    {
        if (!empty($filters['status_id'])) {
            $query->whereHas('people', function($query) use ($filters) {
                $query->where('status_id', $filters['status_id']);
            });
        }

        return $query;
    }
}