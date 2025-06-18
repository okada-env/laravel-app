<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'company_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)
                    ->withPivot('status_id')
                    ->withTimestamps();
    }

    public function contact_person()
    {
        return $this->hasMany(Person::class);
    }
}