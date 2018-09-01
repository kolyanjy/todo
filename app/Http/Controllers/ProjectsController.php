<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function index() {
      $projects = Projects::where('user_id', Auth::user()->id)->get();
      return view('projects/index', ['projects' => $projects]);
    }

    public function create ()
    {
      return view('projects.create');
    }

    public function store (Request $request)
    {
      Projects::create(['name' => $request->name, 'user_id' => Auth::user()->id]);
      return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = Projects::find($id);
        return view ('projects.edit', ['project' => $project]);
    }

    public function update(Request $request, $id)
    {
        $project = Projects::find($id);
        $project->name = $request->name;
        $project->save();
        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
      Projects::destroy($id);
      return redirect()->route('projects.index');
    }
}
