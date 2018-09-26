<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Task;
use Illuminate\Support\Facedes\Auth;

class TasksController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|max:200|',
      'project_id' =>'required'
    ]);
    $task = new Task;
    $task->name = $request->name;
    $task->project_id = $request->project_id;
    $task->order = Task::getLastOrder($request->project_id) + 1;
    return $task->save()
    ? redirect()->route('home')->withSuccess('Task created')
    : redirect()->route('home')->withError('Task c doesn`t created');
  }

  public function edit($id)
  {
    $task = Task::find($id);
    return view('tasks.edit', ['task' => $task]);
  }

  public function update(Request $request, $id)
  {
     $task = Task::find($id);
     $this->validate($request, [
       'name' => 'required|max:255'
     ]);
     $task->name = $request->name;
     return $task->save()
     ? redirect()->route('home')->withSuccess('Task updated')
     : redirect()->route('home')->withError('Task c doesn`t updated');
  }

  public function destroy($id)
  {
    return $task = Task::destroy($id)
    ? redirect()->route('home')->withSuccess('Task deleted')
    : redirect()->route('home')->withError('Task c doesn`t deleted');
  }

  public function change_status($id)
  {
    $task = Task::find($id);
    $task->status = !$task->status;
    $task->save();
  }

  public function change_order(Request $request)
  {
    $result = Task::swap_order($request->target_id, $request->replacement_id);
    return $result
      ? redirect()->route('projects.index')->withSuccess('order changed')
      : redirect()->route('projects.index')->withError('order doesn`t changed');
  }
}
