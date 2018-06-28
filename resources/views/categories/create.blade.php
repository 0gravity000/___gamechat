@extends('layouts.master')

@section('content')
<link href="../css/starter-template.css" rel="stylesheet">
    <h2>カテゴリーを新規追加する</h2>
    <form method="POST" action="/categories/store">
      {{ csrf_field()}}
      <div class="form-group">
        <label for="name">カテゴリー名</label>
        <input type="text" class="form-control" id="name" name="name">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <label for="priority">優先度(数値で指定)</label>
        <input type="text" class="form-control" id="priority" name="priority" value="100">
        <!--<input type="text" class="form-control" id="title" name="title" required>-->
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Add new</button>
      </div>
    @include('layouts.errors')
    <hr>
    </form>
@endsection