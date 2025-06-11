<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_project');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('company_id')
                    ->withTimestamps();
    }

    public function status()
    {
        return $this->belongsToMany(Status::class, 'company_project')
                    ->withPivot('company_id')
                    ->withTimestamps();
    }
}