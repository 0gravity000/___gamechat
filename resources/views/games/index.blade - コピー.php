@extends('layouts.master')
<link href="../css/starter-template.css" rel="stylesheet">

@section('content')
	@for($i = 0; $i < count($videoPlayers_array); $i++)
		{!! array_get($videoPlayers_array[$i], 'player') !!}<br>
	@endfor
@endsection

