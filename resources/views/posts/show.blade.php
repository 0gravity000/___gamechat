@extends('layouts.page')

@section('content')
<link href="../css/starter-template.css" rel="stylesheet">

<button type="button" class="btn btn-outline-primary"><a href="/posts">投稿一覧に戻る</a></button>
<hr>
<div>
<h2>{{ $post->title }}</h2>

  @if(count($post->tags))
    <ul>
      @foreach($post->tags as $tag)
        <button type="button" class="btn btn-outline-success">
        <a href="/posts/tags/{{ $tag->name }}">
          {{ $tag->name }}
        </a>
        </button>
      @endforeach
    </ul>
  @endif
  <hr>
  {!! $page !!}

  </div>
    <hr>
    <!-- Add a comment -->
    <div class="card">
      <div class="card-block">
        <form method="POST" action="/posts/{{ $post->id }}/comments">
          {{ csrf_field() }}
          <div class="form-group">
            <textarea name="body" placeholder="ここにコメントを書いてください" class="form-control" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">この投稿にコメントする</button>
          </div>
        </form>
        @include('layouts.errors')
      </div>
    </div>
    <hr>
    <div class="comments">

    <ui class="list-group">
      @foreach($post->comments as $comment)
        <li class="list-group-item">
          <strong>
            {{ $comment->created_at->diffForHumans() }}: &nbsp;
          </strong>
          {{ $comment->body }}
        </li>
      @endforeach
    </ui>
  </div>

@endsection