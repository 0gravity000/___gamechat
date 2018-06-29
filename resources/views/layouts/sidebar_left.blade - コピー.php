<div>
  <div class="sidebar-module">
    <h2>動画を探す</h2>
    <a href="/videos/search">キーワードで検索する</a><br>
    <a href="/games">ゲーム一覧</a><br>

		@if($res != null)
			@foreach($res->Items->Item as $item)
			    <h5>
					@if (!empty($item->DetailPageURL))
					 	<a href="{{$item->DetailPageURL}}" class="card-link" target="_blank">{{ $item->ItemAttributes->Title }}</a>
					@else
						No URL
					@endif
					</h5>
			@endforeach
		@endif

  </div>
</div>
