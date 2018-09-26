@extends('layouts.app')

@section('content')
    @foreach($projects as $project)

      <div class="todo">
      <div class="container-fluid project-container">
        <div class="container-c container project-header">
          <div class="col-md-1"><i class="fa fa-calendar-alt"></i></div>
          <div class="col-md-9 project-name">{{ $project->name }}</div>

          <div class="col-md-1">
            <a href="{{ route('projects.edit', ['id' => $project->id])  }}">
            <i class="fa fa-pen"></i>
            </a>
          </div>
          <div class="col-md-1">
            <i class="fa fa-trash-alt remove-project"></i>
            <form  action="{{ route('projects.destroy', ['id' => $project->id])  }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token()  }}">
            </form>

          </div>
        </div>
      </div>

      <div class="container-c container task-creating">
        <div class="container-c container text-center create-task">
            <form action="{{ route('tasks.store') }}" method="POST" class="form">
              <div class="col-md-1 p0">
                <i class="glyphicon glyphicon-plus"></i>

              </div>
                <div class="col-md-8 p0">
                    <input type="text" name="name"  class="form-control">
                </div>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-3 p0">
                    <input type="submit" value="Add Task" class="btn btn-default add_task_btn">
                </div>
            </form>
        </div>
               @foreach($project->tasks as $task)
                 @if($task->project_id == $project->id)
                 <div class="task task-row text-center container-fluid">
                   <div class="col-md-1 task_checkbox">
                       <input type="hidden" name="task_id" value="{{ $task->id }}">
                       <input type="hidden" name="order" value="{{ $task->order }}">
                       <input type="checkbox" class="task_checkbox" @if($task->status) checked @endif>
                    </div>
                    <div class="col-md-8 height_100">
                        {{ $task->name }}
                     </div>
                     <div class="col-md-1 height_100 ordering">
                       <form class="" action="{{ route('tasks.order') }}" method="post">
                         <input type="hidden" name="target_id" value="">
                         <input type="hidden" name="replacement_id" value="">
                         <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                       </form>
                       <i class="fa fa-angle-up"></i>
                       <i class="fa fa-angle-down"></i>
                     </div>
                      <div class="col-md-1 height_100">
                          <a href="{{ route('tasks.edit', ['id' => $task->id]) }}">
                              <i class="fa fa-pen task-gi"></i>
                          </a>
                      </div>
                     <div class="col-md-1 height_100">
                         <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="post">
                             <input type="hidden" name="_method" value="DELETE">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         </form>
                         <i class="fa fa-trash remove-task task-gi"></i>
                      </div>
                 </div>
                 @endif
               @endforeach
           </div>
       </div>


</div>

    @endforeach


    <div class="container-c container text-center create-project">
        <a href="{{ route('projects.create') }}" class="btn btn-default todo_create">
          <i class="fa fa-plus"></i><div class="inl-b">
            Add TODO List
          </div>
        </a>
    </div>

@endsection
