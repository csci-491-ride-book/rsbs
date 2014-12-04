@extends('layout')

@section('content')
<div class="row" id="page-header">
    <div class="col-lg-6 text-left">
        <h1>{{ $user->display_name }}'s Details</h1>
    </div>
    <div class="col-lg-5 text-right">
        Logged in as <a href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a>
    </div>
    <div class="col-lg-1 text-left">
        <a href="?logout">Sign Out</a>
    </div>
</div>
@foreach($ridesAsDriver as $ride)
<h5>{{ $ride->id }}</h5>
@endforeach
@stop