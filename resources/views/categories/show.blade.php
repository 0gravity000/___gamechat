@extends('layouts.master')

@section('content')
<link href="../css/starter-template.css" rel="stylesheet">
    <h2>カテゴリーを変更する</h2>
    @foreach($categories as $category)
      <h3>{{ $category->name }}</h3>
    <form method="POST" action="/categories/change">
      {{ csrf_field()}}
        <div class="form-group">
          <div class="form-row">
            <div class="col">
                <label for="tag">選択中のタグ</label>
                <select multiple class="form-control" name="tag_{{ $category->id }}">
                  @foreach($category->tags as $tag)
                    <option>{{ $tag->name }}</option>
                  @endforeach
                  <!--
                  @foreach($category_tags as $ctag)
                    @if($ctag->category_id == $category->id)
                      <option>{{ $tags->where('id', $ctag->tag_id)->first()->name }}</option>
                    @endif
                  @endforeach
                -->
                </select>
            </div>
            <div class="col-1">
                <div class="btn-group-vertical">
                  <button type="submit" class="btn btn-primary" name="action" value="remove">-></button>
                  <button type="submit" class="btn btn-primary" name="action" value="add"><-</button>
                </div>
            </div>
            <div class="col">
                <label for="tag">未選択のタグ</label>
                <select multiple class="form-control" name="tag_{{ $category->id }}">
                  @foreach($category->unSelectedTags($category) as $tag)
                    <option>{{ $tag->name }}</option>
                  @endforeach
                  <!--
                  dd($categories->find(2)->unSelectedTags($categories->find(2)));
                  @foreach($category_tags as $ctag)
                    @if($ctag->category_id != $category->id)
                      <option>{{ $tags->where('id', $ctag->tag_id)->first()->name }}</option>
                    @endif
                  @endforeach
                -->
                </select>
            </div>
          </div>
        </div>
    </form>
    <hr>
    @endforeach

    @include('layouts.errors')
    <hr>

@endsection