<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        return view('admin.industries.index', [
            'industries' => Industry::orderBy('sort_order')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('industries', 'public');
        }

        Industry::create($data);

        return redirect()->route('admin.industries.index')->with('success', 'Industry created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $data = $this->validatedData($request, $industry->id);

        if ($request->hasFile('image')) {
            if ($industry->image) {
                Storage::disk('public')->delete($industry->image);
            }
            $data['image'] = $request->file('image')->store('industries', 'public');
        }

        $industry->update($data);

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        if ($industry->image) {
            Storage::disk('public')->delete($industry->image);
        }

        $industry->delete();

        return back()->with('success', 'Industry deleted successfully.');
    }

    private function validatedData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:industries,slug,' . ($id ?? 'NULL') . ',id'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['title']);
        $data['status'] = $request->boolean('status', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
