@extends('layout')


@section('content')


	<table class="table is-bordered">
	<tr><th>Threshold</th><th>FAR</th><th>FRR</th></tr>
	@foreach ($data as $set)
		<tr>
			<td>{{ $set['threshold'] }}</td>
			<td>{{ $set['far'] }}</td>
			<td>{{ $set['frr'] }}</td>
		</tr>
	@endforeach
	</table>

@endsection