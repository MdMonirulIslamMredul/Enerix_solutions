<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where('status', true)->orderBy('sort_order')->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        $categories = Project::where('status', true)->whereNotNull('category')->distinct()->pluck('category');

        return view('frontend.projects.index', [
            'projects' => $query->paginate(9),
            'categories' => $categories,
            'currentCategory' => $request->query('category'),
            'setting' => Setting::first(),
        ]);
    }

    public function show(Project $project)
    {
        abort_unless($project->status, 404);

        $relatedProjects = Project::where('status', true)
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->take(3)
            ->get();

        return view('frontend.projects.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'setting' => Setting::first(),
        ]);
    }
}
