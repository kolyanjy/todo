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
    $task->save();
    return redirect()->route('home')->withSuccess('Task created');
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
       'name' => 'required|unique:Task|max:255'
     ]);
     $task->name = $request->name;
     $task->save();
     return redirect()->route('home')->withSuccess('Task updated');
  }

  public function destroy($id)
  {
    $task = Task::destroy($id);
    return redirect()->route('home')->withSuccess('Task removed');
  }

  public function change_status($id)
  {
    $task = Task::find($id);
    $task->status = !$task->status;
    $task->save();
  }

  public function change_order(Request $request,$id)
  {
    dd($request);
    // $tasks = self::find([$target_id, $replacement_id]);
    //   if (count($tasks) == 2) {
    //       $first_task_order = $tasks[0] -> order;
    //       $tasks[0] -> order = $tasks[1] -> order;
    //       $tasks[1] -> order = $first_task_order;
    //       DB::beginTransaction();
    //       if (!$tasks[1]->save() || !$tasks[0]->save()) {
    //           DB::rollback();
    //       }
    //       DB::commit();
    //       return 1;
    //   }
  }
}
