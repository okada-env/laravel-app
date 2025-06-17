<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'contact_person',
        'company_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'company_project')
                    ->withPivot('status_id')
                    ->withTimestamps();
    }

    public function pivots()
    {
        return $this->hasMany(Pivot::class);
    }
}