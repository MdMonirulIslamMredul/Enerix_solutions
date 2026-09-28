<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo_path',
        'favicon_path',
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'bg_color',
        'meta_title',
        'meta_description',
        'seo_keywords',
        'hero_title',
        'hero_subtitle',
        'hero_tagline',
        'hero_highlight',
        'hero_description',
        'hero_image_main',
        'hero_image_top',
        'hero_image_mid',
        'hero_image_bot',
        'hero_slider_images',
        'company_intro',
        'cta_title',
        'cta_text',
        'cta_button_text',
        'cta_button_link',
        'why_title',
        'why_subtitle',
        'about_title',
        'about_content',
        'mission',
        'vision',
        'history',
        'contact_email',
        'contact_phone',
        'whatsapp_number',
        'contact_address',
        'google_map_embed',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
        'hero_slider_images' => 'array',
    ];
}
