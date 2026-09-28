<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'icon',
        'features',
        'is_featured',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'status' => 'boolean',
        'features' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
