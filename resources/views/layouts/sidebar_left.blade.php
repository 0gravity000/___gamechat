@extends('layouts.master')
<link href="../css/starter-template.css" rel="stylesheet">

@section('sidebar_left')
  <div class="sidebar-module">
  <!--
    <a href="/videos/search">キーワードで検索する</a><br>
    <a href="/games">ゲーム一覧</a><br>
	-->
		@if($games != null)
			@foreach($games as $game)
				<a href="/games/{{ $game->title }}">{{ $game->title }}</a><br>
			@endforeach
		@endif
	</div>

@endsection
