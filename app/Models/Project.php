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
        'contact_project'
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_project');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    // public function company()
    // {
    //     return $this->belongsTo(Company::class);
    // }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('company_id');
    }
}