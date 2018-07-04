@extends('welcome')

@section('topcontent')
    <link href="../../css/starter-template.css" rel="stylesheet">

    <h1>ゲーム別名の登録</h1>
    <form method="POST" action="/admin/gamealias">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="title">タイトル:</label>
        <select class="form-control" name="title">
          @foreach($games as $game)
            <option value="{{ $game->title }}">{{ $game->title }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="alias">別名:</label>
        <input type="text" class="form-control" name="alias" required>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">登録</button>
      </div>
      <div>
        @include('layouts.errors')
      </div>
    </form>

@endsection
