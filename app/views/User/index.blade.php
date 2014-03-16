@extends('layout')

@section('content')



<h1>All the Users</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Username</td>
			<td>Email</td>
			<td>Messages</td>
		</tr>
	</thead>
	<tbody>
	@foreach($users as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->user_name }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->messages }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<a class="btn btn-small btn-success" href="{{ URL::to('Users/' . $value->id) }}">Show this User</a>

				<a class="btn btn-small btn-info" href="{{ URL::to('Users/' . $value->id . '/edit') }}">Edit this User</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

@stop