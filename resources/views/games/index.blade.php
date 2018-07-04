@extends('layouts.game')

@section('gamecontent')
	<h1>{{ $game->title }}</h1>

	<hr>
		<details>
		  <summary>検索条件を指定する</summary>
			<form method="POST" action="/games/{{ $game->title }}">
	      {{ csrf_field()}}

      <div class="form-group">
        <label for="alias">別名</label>
        <select class="form-control" name="alias">
			      <option value="none" selected="selected">別名で検索しない</option>
          @foreach($aliases as $alias)
            <option value="{{ $alias->title }}">{{ $alias->title }} で検索</option>
          @endforeach
        </select>
      </div>

		  <div class="form-group">
		    <label for="keyword">追加キーワード</label>
		    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="複数指定する場合は空白で区切ってください 例)日本語 実況">
		  </div>

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

