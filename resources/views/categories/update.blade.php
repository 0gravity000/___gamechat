@extends('layouts.master')

@section('content')
<link href="../css/starter-template.css" rel="stylesheet">
    <h2>カテゴリ名を変更する</h2>
    <form method="POST" action="/categories/update">
      {{ csrf_field()}}
      @foreach($categories as $category)
      <div class="form-group">
        <label for="name"></label>
        <input type="text" class="form-control" id="name" name="{{$category->id}}" value="{{$category->name}}">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <label for="name"></label>
        <input type="text" class="form-control" id="priority" name="priority_{{$category->id}}" value="{{$category->priority}}">
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