<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    // Trait providing uploadImage, deleteImage, and syncStorageFiles for reliable asset storage across local and live hosts
    use HandlesImageUploads;

    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => Setting::firstOrCreate([], [
                'site_name' => 'Enerix Solutions',
                'primary_color' => '#0072ce',
                'secondary_color' => '#07132b',
                'accent_color' => '#00c6ff',
                'text_color' => '#1e293b',
                'bg_color' => '#ffffff',
            ]),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'primary_color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/'],
            'secondary_color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/'],
            'accent_color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/'],
            'text_color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/'],
            'bg_color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'seo_keywords' => ['nullable', 'string', 'max:255'],
            
            // Hero section
            'hero_tagline' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_highlight' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            
            // Contact & info
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:255'],
            'why_title' => ['nullable', 'string', 'max:255'],
            'why_subtitle' => ['nullable', 'string'],

            'facebook_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'favicon' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],

            // Hero collage images
            'hero_image_main' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:6144'],
            'hero_image_top' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'hero_image_mid' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'hero_image_bot' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
        ]);

        $setting = Setting::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            $this->deleteImage($setting->logo_path);
            $data['logo_path'] = $this->uploadImage($request->file('logo'), 'settings');
        }

        if ($request->hasFile('favicon')) {
            $this->deleteImage($setting->favicon_path);
            $data['favicon_path'] = $this->uploadImage($request->file('favicon'), 'settings');
        }

        foreach (['hero_image_main', 'hero_image_top', 'hero_image_mid', 'hero_image_bot'] as $heroImgKey) {
            if ($request->hasFile($heroImgKey)) {
                $this->deleteImage($setting->{$heroImgKey});
                $data[$heroImgKey] = $this->uploadImage($request->file($heroImgKey), 'settings');
            }
        }

        $data['primary_color'] = $this->normalizeColor($request->input('primary_color'), '#0072ce');
        $data['secondary_color'] = $this->normalizeColor($request->input('secondary_color'), '#07132b');
        $data['accent_color'] = $this->normalizeColor($request->input('accent_color'), '#00c6ff');
        $data['text_color'] = $this->normalizeColor($request->input('text_color'), '#1e293b');
        $data['bg_color'] = $this->normalizeColor($request->input('bg_color'), '#ffffff');

        $data['social_links'] = [
            'facebook' => $request->input('facebook_url'),
            'linkedin' => $request->input('linkedin_url'),
            'youtube' => $request->input('youtube_url'),
        ];

        unset($data['logo'], $data['favicon'], $data['facebook_url'], $data['linkedin_url'], $data['youtube_url']);

        $setting->update($data);

        return back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Manually synchronize uploaded storage assets into public directories for live/shared hosting.
     */
    public function syncStorage(): RedirectResponse
    {
        $count = $this->syncStorageFiles();

        return back()->with('success', "Storage files synchronized successfully ({$count} files copied to public directory).");
    }

    private function normalizeColor(?string $value, string $default): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return $default;
        }

        return preg_match('/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/', $value) ? strtolower($value) : $default;
    }
}
