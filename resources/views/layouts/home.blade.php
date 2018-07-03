    <div class="text-center">
      <h1 class="display-4">Pick Up</h1>
      <h2>{{ $game->title }}</h2>
    </div>

    <div class="container">

			@if($gameitems != null)
				@foreach($gameitems as $item)
		      <div class="card-deck mb-3 text-center">
		        <div class="card mb-4 box-shadow">
		          <div class="card-header">
		            <h6 class="my-0 font-weight-normal"></h6>
		          </div>
		          <div class="card-body">
								<a href="/games/{{ $game->title }}/{{ $item->id->videoId }}">
								  <img class="mr-3" src="{{ $item->snippet->thumbnails->medium->url }}" alt="Generic placeholder image">
								</a>
		            <h1 class="card-title pricing-card-title">{{ $item->snippet->title }}</h1>
		            <ul class="list-unstyled mt-3 mb-4">
									{{ $item->snippet->description }}
		            </ul>
								<a href="/games/{{ $game->title }}/{{ $item->id->videoId }}">この動画を見る
								</a>

		          </div>
		        </div>
		      </div>
				@endforeach
			@endif

    </div>
