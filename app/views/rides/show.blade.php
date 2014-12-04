@extends('layout')

@section('resources')

@stop

@section('content')
<div class="row" id="page-header">
    <div class="col-lg-6 text-left">
        <h1>Ride Details</h1>
    </div>
    <div class="col-lg-5 text-right">
        Logged in as <a href="{{ route('users.show', $currentUser->id) }}">{{ $currentUser->user_name }}</a>
    </div>
    <div class="col-lg-1 text-left">
        <a href="?logout">Sign Out</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 panel panel-default">
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="destination">Destination:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="destination">{{ $ride->destination }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="origin">Origin:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="origin">{{ $ride->origin }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="date">Departure Date:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="date"><?php
                     $date = new DateTime($ride->date);
                     echo $date->format('m/d/y')
                ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="time">Departure Time:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="time"><?php
                     echo $date->format('g:i A')
                ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="driver">Driver:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="driver">{{ $driver->display_name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 text-left">
                <label for="seats">Open Seats:</label>
            </div>
            <div class="col-lg-4 text-right">
                <p id="seats">{{ $ride->availableSeats() }}</p>
            </div>
            @if (($ride->availableSeats()>0) && ($driver->id !== $currentUser->id) && (!$ride->requestedBy($currentUser->id)))
                {{ Form::open(array('action' => 'RideController@addRequest')) }}
                {{ Form::hidden('rideId', $ride->id) }}
                {{ Form::hidden('userId', $currentUser->id) }}
                <div class="col-lg-4">
                {{ Form::submit('Request Ride', array('class' => 'btn btn-primary')) }}
                </div>
                {{ Form::close() }}
            @elseif(($ride->availableSeats()>0) && ($driver->id !== $currentUser->id) && ($ride->requestedBy($currentUser->id)))
                <div class="col-lg-4">
                    <i>Ride Requested</i>
                </div>
            @endif
        </div>
    </div>
</div>
@stop