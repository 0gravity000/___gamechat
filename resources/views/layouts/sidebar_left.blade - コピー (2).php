@extends('layouts.master')
<link href="../css/starter-template.css" rel="stylesheet">

@section('sidebar_left')
    <a href="/videos/search">キーワードで検索する</a><br>
    <a href="/games">ゲーム一覧</a><br>
		@if($games != null)
			@foreach($games as $game)
			    <h5>{{ $game->title }}</h5><br>
			@endforeach
		@endif
@endsection

