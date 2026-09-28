<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('service')->orderBy('sort_order')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create', [
            'services' => Service::where('status', true)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'services' => Service::where('status', true)->get(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validatedData($request, $project->id);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return back()->with('success', 'Project deleted successfully.');
    }

    private function validatedData(Request $request, ?int $id = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug,' . ($id ?? 'NULL') . ',id'],
            'spec_subtitle' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'service_id' => ['nullable', 'exists:services,id'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'completion_date' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = !empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['status'] = $request->boolean('status', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
