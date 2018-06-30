  <div>
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">{{ $game->title }}</h1>
	    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
	  </div>
	</div>


		@if($gameitems != null)
			@foreach($gameitems as $item)
			<div class="card" style="width: 16rem;">
					<img class="card-img-top" src="{{ $item->snippet->thumbnails->default->url }}" alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-title">
							{{ $item->snippet->title }}
					</h5>
			    <h6 class="card-subtitle mb-2 text-muted"></h6>
			    <p class="card-text">
							{{ $item->snippet->description }}
			    </p>
					 	<a href="#" class="card-link" target="_blank">動画を見る</a></li>
			  </div>
			</div>
			@endforeach
		@endif


  </div>

