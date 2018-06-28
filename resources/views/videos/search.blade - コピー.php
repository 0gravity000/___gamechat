@extends('layouts.master')
<link href="../css/starter-template.css" rel="stylesheet">

@section('content')

		@if($res != null)
			@foreach($res->Items->Item as $item)
			<div class="card" style="width: 16rem;">
				@if (!empty($item->MediumImage->URL))
					<img class="card-img-top" src="{{$item->MediumImage->URL}}" alt="Card image cap">
				@else
					No Image
				@endif
			  <div class="card-body">
			    <h5 class="card-title">Card title
						@if (!empty($item->ItemAttributes->Title)) 
							{{ $item->ItemAttributes->Title }}
						@else
							No Title
						@endif
					</h5>
			    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
			    <p class="card-text">
						@if (!empty($item->Offers->Offer->OfferListing->Price->Amount))
						 	{{$item->Offers->Offer->OfferListing->Price->Amount}} 円
						@else
							No Price
						@endif
			    </p>
					@if (!empty($item->DetailPageURL))
					 	<a href="{{$item->DetailPageURL}}" class="card-link" target="_blank">商品リンク</a></li>
					@else
						No URL
					@endif
			  </div>
			</div>
			@endforeach
		@endif

 <!--
	@foreach($items as $item)
		{!! $item->player->embedHtml !!}<br>
		<br>
	@endforeach
-->
@endsection

