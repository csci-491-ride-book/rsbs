@extends('layout')

@section('content')

<!-- will be used to show any messages -->
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <h2>Hello {{$current_user->user_name}}</h2>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('RidePostings') }}">Rides</a></li>
        <li><a href="{{ URL::to('BookPostings') }}">Books</a></li>
        <li><a href="{{ URL::to('Users/create') }}">Create a User</a></li>
    </ul>
</nav>

<h3>Ride Sharing</h3>

<table class="table table-striped table-bordered" style="width: 500px; float: left">
    <caption>Rides offered by you</caption>
    <thead>
        <tr>
            <td>To</td>
            <td>From</td>
            <td>Date/Time</td>
            <td>Requests</td>
        </tr>
    </thead>
    <tbody>
        @foreach($rides as $key => $value)
        <tr>
            <td>{{ $value->ride->to }}</td>
            <td>{{ $value->ride->from }}</td>
            <td>{{ $value->ride->date }}</td>
            <td><a href="{{ URL::to('RideRequests') }}">{{ $value->rideRequests->count() }} Pending</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-striped table-bordered" style="width: 500px; float: left">
    <caption>Rides requested by you</caption>
    <thead>
        <tr>
            <td>To</td>
            <td>From</td>
            <td>Date/Time</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $value)
        <tr>
            <td>{{ $value->posting->ride->to }}</td>
            <td>{{ $value->posting->ride->from }}</td>
            <td>{{ $value->posting->ride->date }}</td>
            <td>{{ $value->status ? 'accepted' : 'pending'}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 style="width: 100%; float: left">Book Selling</h3>

<table class="table table-striped table-bordered" style="width: 500px; float: left">
    <caption>Books you're selling</caption>
    <thead>
        <tr>
            <td>Title</td>
            <td>Author</td>
            <td>ISBN</td>
            <td>Class</td>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $value)
        <tr>
            <td>{{ $value->book->title }}</td>
            <td>{{ $value->book->author }}</td>
            <td>{{ $value->book->ISBN }}</td>
            <td>{{ $value->book->class }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop