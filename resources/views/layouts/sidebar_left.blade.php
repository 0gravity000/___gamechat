@extends('layouts.master')
<link href="../css/starter-template.css" rel="stylesheet">

@section('sidebar_left')

<div>
  <div class="sidebar-module">
    <h2>動画を探す</h2>
    <a href="/videos/search">キーワードで検索する</a><br>
    <a href="/games">ゲーム一覧</a><br>

		@if($res != null)
			@foreach($res->Items->Item as $item)
			<div class="card" style="width: 16rem;">
				@if (!empty($item->MediumImage->URL))
					<img class="card-img-top" src="{{$item->MediumImage->URL}}" alt="Card image cap">
				@else
					No Image
				@endif
			  <div class="card-body">
			    <h5 class="card-title">
						@if (!empty($item->ItemAttributes->Title)) 
							{{ $item->ItemAttributes->Title }}
						@else
							No Title
						@endif
					</h5>
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

  </div>
</div>

@endsection
