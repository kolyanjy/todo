<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['id', 'name', 'order', 'status', 'project_id'];


    public static function getLastOrder($project_id)
    {
      $task = self::where('project_id', $project_id)->orderBy('order', 'desc')->first();
      return $task ? $task->order : 0;
    }

    public static function swap_order($target_id, $replacement_id)
    {
      $tasks = self::find([$target_id, $replacement_id]);
      if (!count($tasks) == 2) {
        return false;
      }
      $first_task_order = $tasks->first()-> order;
      $tasks->first()-> order = $tasks->last() -> order;
      $tasks->last() -> order = $first_task_order;
      DB::beginTransaction();
      if (!$tasks->last()->save() || !$tasks->first()->save()) {
        DB::rollback();
        return false;
      }
      DB::commit();
      return true;

    }

}
