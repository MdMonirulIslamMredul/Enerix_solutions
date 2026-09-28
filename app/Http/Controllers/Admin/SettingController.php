<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
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
            'logo' => ['nullable', 'image', 'max:4096'],
            'favicon' => ['nullable', 'image', 'max:1024'],

            // Hero collage images
            'hero_image_main' => ['nullable', 'image', 'max:6144'],
            'hero_image_top' => ['nullable', 'image', 'max:4096'],
            'hero_image_mid' => ['nullable', 'image', 'max:4096'],
            'hero_image_bot' => ['nullable', 'image', 'max:4096'],
        ]);

        $setting = Setting::firstOrCreate([]);

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon_path) {
                Storage::disk('public')->delete($setting->favicon_path);
            }
            $data['favicon_path'] = $request->file('favicon')->store('settings', 'public');
        }

        foreach (['hero_image_main', 'hero_image_top', 'hero_image_mid', 'hero_image_bot'] as $heroImgKey) {
            if ($request->hasFile($heroImgKey)) {
                if ($setting->{$heroImgKey}) {
                    Storage::disk('public')->delete($setting->{$heroImgKey});
                }
                $data[$heroImgKey] = $request->file($heroImgKey)->store('settings', 'public');
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

    private function normalizeColor(?string $value, string $default): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return $default;
        }

        return preg_match('/^#([0-9A-Fa-f]{3}|[0-9A-Fa-f]{6})$/', $value) ? strtolower($value) : $default;
    }
}
