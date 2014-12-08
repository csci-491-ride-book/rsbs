@extends('layout')

@section('resources')

@stop

@section('content')
<div class="row">
    <div class="col-lg-6 text-left">
        <h1>Ride Details</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-5 well">
        <div class="row">
            <label class="control-label col-lg-4">Destination:</label>
            <div class="col-lg-4 text-right">
                {{ $ride->destination }}
            </div>
        </div>
        <div class="row">
            <label class="control-label col-lg-4">Origin:</label>
            <div class="col-lg-4 text-right">
                {{ $ride->origin }}
            </div>
        </div>
        <div class="row">
            <label class="control-label col-lg-4">Departure Date:</label>
            <div class="col-lg-4 text-right">
                <?php
                     $date = new DateTime($ride->date);
                     echo $date->format('m/d/y')
                ?>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-lg-4">Departure Time:</label>
            <div class="col-lg-4 text-right">
                <?php
                     echo $date->format('g:i A')
                ?>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-lg-4">Driver:</label>
            <div class="col-lg-4 text-right">
                {{ $driver->display_name }}
            </div>
        </div>
        <div class="row">
            <label class="control-label col-lg-4">Open Seats:</label>
            <div class="col-lg-4 text-right">
                {{ $ride->availableSeats() }}
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
        <div class="row">
            <label class="control-label col-lg-4">Confirmed Riders:</label>
            @if ($passengers->count()>0)
                <div class="col-lg-4 text-right">
                    {{ $passengers[0]->display_name }}
                </div>
            @else
                <div class="col-lg-4 text-right">
                    <i>Available</i>
                </div>
            @endif
            @for ($i = 1; $i < $passengers->count(); $i++)
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4 text-right">
                        {{ $passengers[i]->display_name }}
                    </div>
                </div>
            @endfor
            @for ($j = 1; $j < $ride->availableSeats(); $j++)
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4 text-right">
                        <i>Available</i>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Comments</h3>
        </div>
        <ul class="list-group">
            @foreach($comments as $comment)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-lg-3 text-left">
                        {{ User::find($comment->user_id)->display_name }}<br />
                        <?php
                            $commentDate = new DateTime($comment->created_at);
                            echo $commentDate->format('m/d/y g:i A'); ?>
                    </div>
                    <p class="col-lg-9">{{ $comment->message_body }}</p>
                </div>
            </li>
            @endforeach
            <li class="list-group-item">
                <div class="row">
                    {{ Form::open(array('action' => 'RideController@addComment')) }}
                    {{ Form::hidden('rideId', $ride->id) }}
                    {{ Form::hidden('userId', $currentUser->id) }}
                    <div class="col-lg-12">
                        <div class="input-group">
                            {{ Form::text('messageBody', Input::old('messageBody'), array('class' => 'form-control', 'maxlength' => '255', 'placeholder' => 'Add a comment...')) }}
                            <span class="input-group-btn">
                                {{ Form::submit('Submit', array('class' => "btn btn-default", 'type' => 'button')) }}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@stop