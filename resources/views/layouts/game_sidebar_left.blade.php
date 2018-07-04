<link href="../css/starter-template.css" rel="stylesheet">

<div>
  <div class="sidebar-module">
  	<a href="/home">他のゲームを見る</a><br>
  	<a href="/games/{{ $game->title }}">動画を見る</a><br>
		<a href="https://www.amazon.jp/reviews/iframe?akid=AKIAJIBKAZG572BYFPPA&alinkCode=xm2&asin=B078KHK41B&atag=starfish860-22&exp=2018-07-01T10%3A37%3A33Z&v=2&sig=9dWl2iF%252FmB8htCqnYp0cp8KBGVUrtIcHfJVCE2E65jk%253D" target="_blank">Amazonカスタマーレビューをチェックする</a><br>
  	<a href="">コメントする</a><br>
		<strong>人気のキーワード</strong><br>
		@foreach($game->gamekeywords->sortByDesc('count') as $keyword)
	  	<strong>{{ $keyword->keyword }}</strong>
		@endforeach

  </div>
</div>
