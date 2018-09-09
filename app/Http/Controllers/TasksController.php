<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Task;
use Illuminate\Support\Facedes\Auth;


class TaskController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:200|',
      'project_id' =>'required'
    ]);
    Task::create([
      'name' => $request->name,
      'project_id' => $request->project_id
    ]);
    return redirect()->route('projects.index')->withSuccess('Task created');
  }

  public function edit($id)
  {
    $task = Task::find($id);
    return view('Task.edit', ['task' => $task]);
  }

  public function update(Request $request, $id)
  {
     $task = Task::find($id);
     $this->validate($request, [
       'name' => 'required|unique:Task|max:255'
     ]);
     $task->name = $request->name;
     $task->save();
     return redirect()->route('projects.index')->withSuccess('Task updated');
  }

  public function destroy($id)
  {
    $task = Task::destroy($id);
    return redirect()->route('projects.index')->withSuccess('Task removed');
  }

  public function change_status($id)
  {
    $task = Task::find($id);
    $task->status = !$task->status;
    $task->save();
  }
}
