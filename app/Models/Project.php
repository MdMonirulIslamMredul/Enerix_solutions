<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'spec_subtitle',
        'location',
        'category',
        'service_id',
        'client_name',
        'completion_date',
        'short_description',
        'description',
        'image',
        'gallery_images',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'status' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
