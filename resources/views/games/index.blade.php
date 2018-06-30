@extends('layouts.game')

@section('gamecontent')
	<h1>{{ $game->title }}</h1>
	<hr>
	フィルター
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
	    <li class="page-item"><a class="page-link" href="#">1</a></li>
	    <li class="page-item"><a class="page-link" href="#">2</a></li>
	    <li class="page-item"><a class="page-link" href="#">3</a></li>
	    <li class="page-item"><a class="page-link" href="#">Next</a></li>
	  </ul>
	</nav>



@endsection

