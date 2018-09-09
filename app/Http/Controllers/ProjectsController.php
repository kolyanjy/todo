<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index() {
      return view('projects/index', ['projects' => Project::getProjectsWithTasks()]);
    }

    public function create ()
    {
      return view('projects.create');
    }

    public function store (Request $request)
    {
      $this->validate($request, [
        'name' => 'required|unique:projects|max:127'
      ]);
      Project::create(['name' => $request->name, 'user_id' => Auth::user()->id]);
      return redirect()->route('projects.index')->withSuccess('project created');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        if(!$project) return redirect()->back()->withError('Project not found');
        return view ('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $this->validate($request, [
          'name' => 'required|unique:projects|max:127'
        ]);
        $project->name = $request->name;
        return $project->save()
          ? redirect()->route('projects.index')->withSuccess('project updated')
          : redirect()->route('projects.index')->withError('project doesn`t updated');
    }

    public function destroy($id)
    {
      Project::destroy($id);
      return redirect()->route('projects.index')->withSuccess('project removed');
    }
}
