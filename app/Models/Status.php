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

    // ステータスの定数定義
    const STATUS_IN_PROGRESS = '進行中';
    const STATUS_ACCEPTED = '受注';
    const STATUS_LOST = '失注';

    // 利用可能なステータス一覧
    public static $availableStatuses = [
        self::STATUS_IN_PROGRESS => '進行中',
        self::STATUS_ACCEPTED => '受注',
        self::STATUS_LOST => '失注',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'person_project')
                    ->withPivot('company_id', 'person_id')
                    ->withTimestamps();
    }

    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('company_id', 'project_id')
                    ->withTimestamps();
    }
}
