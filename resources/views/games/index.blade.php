@extends('layouts.game')

@section('gamecontent')
	<h1>{{ $game->title }}</h1>
	<hr>
		<details>
		  <summary>検索条件を指定する</summary>
			<form method="POST" action="/games/{{ $game->title }}">
	      {{ csrf_field()}}

				<div class="row">
	      <div class="col">
				  <div class="form-group">
				    <label for="order">並べ替え</label>
				    <select class="form-control" id="order" name="order">
				      <option value="relevance" selected="selected">関連度順</option>
				      <option value="viewCount">視聴回数</option>
				      <option value="rating">評価</option>
				      <option value="date">アップロード日</option>
				    </select>
				  </div>
				</div>

	      <div class="col">
				  <div class="form-group">
				    <label for="langage">言語</label>
				    <select class="form-control" id="langage" name="langage">
				      <option value="" selected="selected">指定しない</option>
				      <option value="日本語">日本語</option>
				      <option value="english">英語</option>
				      <option value="中国">中国語</option>
				      <option value="Español">スペイン語</option>
				      <option value="Deutsch">ドイツ語</option>
				      <option value="Français">フランス語</option>
				      <option value="한국">韓国語</option>
				    </select>
				  </div>
				</div>

	      <div class="col">
				  <div class="form-group">
				    <label for="videoCaption">字幕</label>
				    <select class="form-control" id="videoCaption" name="videoCaption">
				      <option value="any" selected="selected">有無を問わない</option>
				      <option value="closedCaption">有りのみ</option>
				    </select>
				  </div>
				</div>
				</div>

	      <div class="form-group">
	        <button type="submit" class="btn btn-primary">この条件で検索する</button>
	      </div>

			</form>
		</details>

	<hr>

	@if($gameitems != null)
		@foreach($gameitems as $item)
		<div class="media">
			<a href="/games/{{ $game->title }}/{{ $item->id->videoId }}">
			  <img class="mr-3" src="{{ $item->snippet->thumbnails->default->url }}" alt="Generic placeholder image">
			</a>
		  <div class="media-body">
		    <h5 class="mt-0">
					<a href="/games/{{ $game->title }}/{{ $item->id->videoId }}">{{ $item->snippet->title }}</a>
		    </h5>
					{{ $item->snippet->description }}
		  </div>
		</div>
		<br>
		@endforeach
	@endif

	<nav aria-label="Page navigation example">
	  <ul class="pagination">
	    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
	    <li class="page-item"><a class="page-link" href="#">Next</a></li>
	  </ul>
	</nav>



@endsection

