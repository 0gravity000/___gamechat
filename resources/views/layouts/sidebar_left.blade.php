<link href="../css/starter-template.css" rel="stylesheet">

  <div class="sidebar-module">
  <!--
    <a href="/videos/search">キーワードで検索する</a><br>
    <a href="/games">ゲーム一覧</a><br>
	-->
		@if($games != null)
			@foreach($games as $game)
				<a href="/games/{{ $game->id }}">{{ $game->title }}</a><br>
			@endforeach
		@endif
	</div>
