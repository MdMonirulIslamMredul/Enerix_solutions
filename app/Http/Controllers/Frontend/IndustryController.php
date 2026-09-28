<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Service;
use App\Models\Setting;

class IndustryController extends Controller
{
    public function index()
    {
        return view('frontend.industries.index', [
            'industries' => Industry::where('status', true)->orderBy('sort_order')->get(),
            'setting' => Setting::first(),
        ]);
    }

    public function show(Industry $industry)
    {
        abort_unless($industry->status, 404);

        $otherIndustries = Industry::where('status', true)
            ->where('id', '!=', $industry->id)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $solutions = Service::where('status', true)->orderBy('sort_order')->take(4)->get();

        return view('frontend.industries.show', [
            'industry' => $industry,
            'otherIndustries' => $otherIndustries,
            'solutions' => $solutions,
            'setting' => Setting::first(),
        ]);
    }
}
