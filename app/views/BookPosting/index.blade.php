@extends('layout')

@section('content')



<h1>Find a Book</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<body>

  <a class="btn btn-small btn-success" href="{{ URL::to('BookPostings/create') }}">Sell a Book</a>

  <a class="btn btn-small btn-success" href="{{ URL::to('BookPostings') }}">Search for a Book</a>

  <table class="table table-striped table-bordered" style="width: 700px; float: left">
  	<thead>
  		<tr>
  			<td>Title</td>
  			<td>Author</td>
  			<td>ISBN</td>
  			<td>Class</td>
  		</tr>
  	</thead>
  	<tbody>
  	@foreach($books as $key => $value)
  		<tr>
  			<td>{{ $value->title }}</td>
  			<td>{{ $value->author }}</td>
  			<td>{{ $value->ISBN }}</td>
  			<td>{{ $value->class }}</td>

  			<!-- we will also add show, edit, and delete buttons -->
  			<!-- <td>

  				<a class="btn btn-small btn-success" href="{{ URL::to('Rides/' . $value->id) }}">Show this Ride</a>

  				<a class="btn btn-small btn-info" href="{{ URL::to('Rides/' . $value->id . '/edit') }}">Edit this Ride</a>

  			</td> -->
  		</tr>
  	@endforeach
  	</tbody>
  </table>
</body>
@stop