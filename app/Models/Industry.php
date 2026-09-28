<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'short_description',
        'description',
        'image',
        'icon',
        'solutions_offered',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'solutions_offered' => 'array',
        'status' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
