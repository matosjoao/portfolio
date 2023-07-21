<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index', [
            'projects' => Project::orderBy('order_number', 'asc')->paginate(5)
        ]);
    }

    public function show(Project $project)
    {
        return view('admin.project.show', ['project' => $project]);
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store()
    {
        Project::create(array_merge($this->validateProject(), [
            'slug' => Str::slug(request('title')),
            'highlighted' => request('highlighted') === 'on' ? 1 : 0,
            'active' => request('active') === 'on' ? 1 : 0
        ]));

        return back()->with('success', 'Projeto criado com sucesso!');
    }

    public function edit(Project $project)
    {
        return view('admin.project.edit', ['project' => $project]);
    }

    public function update(Project $project)
    {
        $attributes = $this->validateProject($project);
        $attributes['highlighted'] = request('highlighted') === 'on' ? 1 : 0 ;
        $attributes['active'] = request('active') === 'on' ? 1 : 0 ;
        $project->update($attributes);

        return redirect('/admin/project')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Projeto eliminado com sucesso!');
    }

    protected function validateProject(?Project $project = null): array
    {
        $project ??= new Project();

        return request()->validate([
            'title' => 'required',
            'subtitle' => 'max:255',
            'description' => 'max:1500',
            'order_number' => 'required',
        ]);
    }
}
