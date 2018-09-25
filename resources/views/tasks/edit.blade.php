@extends('layouts.app')

@section('content')
  <div class="container text-center">
    <form action="{{ route("tasks.update", ['id' => $task->id]) }}" method="POST" class="form">
      <input type="text" name="name" value="{{ $task->name }}" class="form-control input-edit">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" value="update" class="btn btn-default">
    </form>
  </div>
@endsection
