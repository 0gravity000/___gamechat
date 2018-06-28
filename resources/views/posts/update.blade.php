@extends('layouts.master')

@section('content')
  <link href="../../css/starter-template.css" rel="stylesheet">
    <h1>投稿を編集する</h1>

    <form method="POST" action="/posts/update/{{ $post->id }}">
      {{ csrf_field()}}
      @foreach($tags as $tag)
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="{{$tag->id}}" value="{{$tag->id}}">
        <label class="form-check-label" for="tag">{{$tag->name}}</label>
      </div>
      @endforeach
      <hr>

      <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>

      <div class="form-group">
        <label for="body" title="\storage\app\public\pages以下のパスを指定。拡張子なし">リンクパス</label>
        <textarea id="body" name="body" class="form-control">{!! $post->body !!}</textarea>
        <!--<textarea id="body" name="body" class="form-control" required></textarea>-->
      </div>

      <div class="form-group">
        <label for="priority">優先度(数値で指定)</label>
        <input type="text" class="form-control" id="priority" name="priority" value="{{$post->priority}}">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">edit</button>
      </div>

      @include('layouts.errors')

    </form>
@endsection