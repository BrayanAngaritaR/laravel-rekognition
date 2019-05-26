@extends('layouts.app')
@section('form_open')

<form action="{{ route('text.submit') }}" method="post" enctype="multipart/form-data">

	
</div>
@endsection

@if(isset($results))
@section('foreach')
	@foreach($results as $key => $value)
		<tr>
			<td>{{$results[$key]['DetectedText']}}</td>
			<td>{{round($results[$key]['Confidence'], 2)}}%</td>
		</tr>
	@endforeach
@endsection
@endif