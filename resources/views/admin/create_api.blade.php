@extends('welcome')

@section('topcontent')
    <link href="../../css/starter-template.css" rel="stylesheet">

    <h1>API Keyの登録</h1>
    <form method="POST" action="/admin/api">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="google_key">Google API Key:</label>
        <input type="text" class="form-control" name="google_key" required>
      </div>
      <div class="form-group">
        <label for="amazon_key">Amazon access Key:</label>
        <input type="text" class="form-control" name="amazon_key" required>
      </div>
      <div class="form-group">
        <label for="amazon_secret">Amazon secret Key:</label>
        <input type="text" class="form-control" name="amazon_secret" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">登録</button>
      </div>
      <div>
        @include('layouts.errors')
      </div>
    </form>

@endsection
