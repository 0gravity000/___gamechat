@extends('layouts.master')

@section('content')
<link href="../css/starter-template.css" rel="stylesheet">
    <h2>タグ名を変更する</h2>
    <form method="POST" action="/tags/update">
      {{ csrf_field()}}
      @foreach($tags as $tag)
      <div class="form-group">
        <label for="name"></label>
        <input type="text" class="form-control" id="name" name="{{$tag->id}}" value="{{$tag->name}}">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <label for="name"></label>
        <input type="text" class="form-control" id="priority" name="priority_{{$tag->id}}" value="{{$tag->priority}}">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <hr>
      @endforeach
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Rename</button>
      </div>
    </form>
    @include('layouts.errors')
@endsection