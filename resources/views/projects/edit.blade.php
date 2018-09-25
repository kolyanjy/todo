@extends('layouts.app')

@section('content')
  <div class="container text-center">
    <form action="{{ route('projects.update', ['id'=> $project->id]) }}" method="post" class="form">
      <input type="text" name="name" value="{{ $project->name }}" class="form-control input-edit">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" class="btn btn-default" value="update">
    </form>
  </div>
@endsection
