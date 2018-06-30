@extends('layouts.game')
<link href="../../css/starter-template.css" rel="stylesheet">

@section('gamecontent')
	<h1>{{ $game->title }}</h1>
	<hr>
	<a href="/games/{{ $game->title }}">{{ $game->title }}の一覧に戻る</a><br>
	<hr>
	@if($videoitems != null)
		@foreach($videoitems as $item)

		{!! $item->player->embedHtml !!}<br>

		<h2>{{ $item->snippet->title }}</h2>
		<h3>チャンネル：{{ $item->snippet->channelTitle }}</h3>
		<h3>チャンネルID：{{ $item->snippet->channelId }}</h3>
		{{ $item->snippet->description }}<br>
		<br>
		@endforeach
	@endif

@endsection

