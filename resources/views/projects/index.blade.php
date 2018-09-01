@extends('layouts.app')

@section('content')
    @foreach($projects as $project)
      <div class="container-fluid project-container">
        <div class="container project-header">
          <div class="col-md-1"><i class="glyphicon glyphicon-calendar"></i></div>
          <div class="col-md-9 project-name">{{ $project->name }}</div>

          <div class="col-md-1">
            <a href="{{ route('projects.edit', ['id' => $project->id])  }}">
            <i class="glyphicon glyphicon-pencil"></i>
            </a>
          </div>
          <div class="col-md-1">
            <i class="glyphicon glyphicon-trash remove-project"></i>
            <form  action="{{ route('projects.destroy', ['id' => $project->id])  }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token()  }}">
            </form>

          </div>
        </div>
      </div>


    @endforeach

    <div class="container text-center create-project">
        <a href="{{ route('projects.create') }}" class="btn btn-default">create</a>
    </div>

@endsection
