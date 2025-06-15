<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'company_id',
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

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('status_id')
                    ->withTimestamps();
    }

    public function status(): BelongsToMany
    {
        return $this->belongsToMany(Status::class, 'person_project', 'project_id', 'status_id')
                    ->withPivot('company_id', 'person_id')
                    ->withTimestamps();
    }
}