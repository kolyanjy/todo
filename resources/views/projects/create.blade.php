@extends('layouts.app');

@section('content')
    <div class="container text-center">
      <form class="form" action="{{ route('projects.store') }}" method="post">
        <input type="text" name="name" class="form-control" placeholder="project name">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-default" value="create">
      </form>
    </div>
@endsection
